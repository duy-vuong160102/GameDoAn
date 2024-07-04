using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;
using System.Collections;

public class UserInfoFetcher : MonoBehaviour
{
    private string baseUrl = "http://localhost/Game/getUserInfo.php"; // Thay thế bằng URL của bạn

    // Thêm các biến để tham chiếu đến các Text UI
    public Text playerNameText;
    public Text scoreText;


    public void FetchUserInfo(string username)
    {
        StartCoroutine(GetUserInfo(username));
    }

    private IEnumerator GetUserInfo(string username)
    {
        string url = baseUrl + "?username=" + UnityWebRequest.EscapeURL(username);
        UnityWebRequest www = UnityWebRequest.Get(url);

        yield return www.SendWebRequest();

        if (www.result == UnityWebRequest.Result.ConnectionError || www.result == UnityWebRequest.Result.ProtocolError)
        {
            Debug.LogError(www.error);
        }
        else
        {
            Debug.Log(www.downloadHandler.text);
            User user = JsonUtility.FromJson<User>(www.downloadHandler.text);
            UpdateUI(user);
        }
    }

    private void UpdateUI(User user)
    {
        if (user != null)
        {
            playerNameText.text = "" + user.player_name;
            scoreText.text = "Điểm cao nhất: " + user.score;
        }
        else
        {
            playerNameText.text = "Player Name: Not found";
            scoreText.text = "Score: Not found";
        }
    }

    [System.Serializable]
    public class User
    {
        public string username;
        public string player_name;
        public int score;
    }
}
