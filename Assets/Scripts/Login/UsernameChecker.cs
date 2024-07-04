using UnityEngine;
using UnityEngine.Networking;
using System.Collections;
using UnityEngine.UI;

public class UsernameChecker : MonoBehaviour
{
    private string checkUrl = "http://localhost/Game/checkPlayerName.php"; // Thay thế bằng URL của bạn
    private string updateUrl = "http://localhost/Game/updatePlayerName.php"; // Thay thế bằng URL của bạn

    public InputField playerNameInputField;
    public Text statusText;
    public Text username; // Tên người dùng hiện tại

    public void CheckAndUpdatePlayerName()
    {
        string newPlayerName = playerNameInputField.text;
        StartCoroutine(CheckPlayerNameCoroutine(newPlayerName));
    }

    private IEnumerator CheckPlayerNameCoroutine(string player_name)
    {
        string url = checkUrl + "?player_name=" + UnityWebRequest.EscapeURL(player_name);
        UnityWebRequest www = UnityWebRequest.Get(url);

        yield return www.SendWebRequest();

        if (www.result == UnityWebRequest.Result.ConnectionError || www.result == UnityWebRequest.Result.ProtocolError)
        {
            Debug.LogError(www.error);
        }
        else
        {
            Debug.Log(www.downloadHandler.text);
            var result = JsonUtility.FromJson<PlayerNameCheckResult>(www.downloadHandler.text);
            if (result.exists)
            {
                statusText.text = "Player name already exists. Please choose another one.";
            }
            else
            {
                StartCoroutine(UpdatePlayerNameCoroutine(player_name));
            }
        }
    }

    private IEnumerator UpdatePlayerNameCoroutine(string newPlayerName)
    {
        WWWForm form = new WWWForm();
        form.AddField("newPlayerName", newPlayerName);

        UnityWebRequest www = UnityWebRequest.Post(updateUrl, form);

        yield return www.SendWebRequest();

        if (www.result == UnityWebRequest.Result.ConnectionError || www.result == UnityWebRequest.Result.ProtocolError)
        {
            Debug.LogError(www.error);
        }
        else
        {
            Debug.Log(www.downloadHandler.text);
            var result = JsonUtility.FromJson<UpdatePlayerNameResult>(www.downloadHandler.text);
            if (result.success)
            {
                statusText.text = "Player name updated successfully!";
            }
            else
            {
                statusText.text = "Failed to update player name: " + result.error;
            }
        }
    }

    [System.Serializable]
    public class PlayerNameCheckResult
    {
        public bool exists;
    }

    [System.Serializable]
    public class UpdatePlayerNameResult
    {
        public bool success;
        public string error;
    }
}
