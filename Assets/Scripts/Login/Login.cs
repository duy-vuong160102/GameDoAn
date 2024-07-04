using System;
using System.Collections;
using TMPro;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;

public class Login : MonoBehaviour
{
    [SerializeField] GameObject Play;
    [SerializeField] GameObject ad;
    [SerializeField] Text user;
    public string loginUrl = "http://localhost/Game/login.php";
    public Text feedbackText;  // Thêm một Text UI để hiển thị phản hồi

    public void LoginUser(string username, string password)
    {
        StartCoroutine(LoginCoroutine(username, password));
    }

    IEnumerator LoginCoroutine(string username, string password)
    {
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        form.AddField("password", password);

        using (UnityWebRequest www = UnityWebRequest.Post(loginUrl, form))
        {
            yield return www.SendWebRequest();

            if (www.result == UnityWebRequest.Result.Success)
            {
                string response = www.downloadHandler.text;
                if (response == "Đăng nhập thành công")
                {
                    feedbackText.text = "Login successful";
                    Play.SetActive(true);
                    //ad.SetActive(false);
                    // Redirect to the main game scene or do whatever you need
                }
                else
                {
                    feedbackText.text = response;
                }
            }
            else
            {
                feedbackText.text = www.error;
            }
        }


    }
}

