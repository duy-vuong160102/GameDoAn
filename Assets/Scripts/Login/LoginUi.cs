using UnityEngine;
using UnityEngine.UI;

public class LoginUi : MonoBehaviour
{
    public InputField usernameField;
    public InputField passwordField;
    public Button loginButton;
    public Login loginScript;
    public Text feedbackText;

    void Start()
    {
        loginButton.onClick.AddListener(OnLoginButtonClick);
        loginScript.feedbackText = feedbackText;
    }

    void OnLoginButtonClick()
    {
        string username = usernameField.text;
        string password = passwordField.text;

        loginScript.LoginUser(username, password);
    }
}
