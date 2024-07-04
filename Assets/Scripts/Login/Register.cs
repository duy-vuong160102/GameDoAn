using System.Collections;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;

public class Register : MonoBehaviour
{
    public string registerUrl = "http://localhost/Game/register.php";
    public Text responseText;


    public void RegisterUser(string username, string password, string email, string playerName)
    {
        StartCoroutine(RegisterCoroutine(username, password, email, playerName));
    }

    private IEnumerator RegisterCoroutine(string username, string password, string email, string playerName)
    {
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        form.AddField("password", password);
        form.AddField("email", email);
        form.AddField("player_name", playerName);

        using (UnityWebRequest www = UnityWebRequest.Post(registerUrl, form))
        {
            yield return www.SendWebRequest();

            if (www.result != UnityWebRequest.Result.Success)
            {
                Debug.LogError(www.error);
                responseText.text = www.error;
            }
            else
            {
                Debug.Log(www.downloadHandler.text);
                responseText.text = www.downloadHandler.text;
            }
        }
    }
}