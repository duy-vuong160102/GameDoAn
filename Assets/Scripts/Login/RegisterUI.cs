using UnityEngine;
using UnityEngine.UI;

public class RegisterUI : MonoBehaviour
{
    public InputField usernameField;
    public InputField passwordField;
    public InputField emailField;
    public Button registerButton;
    public InputField playNameField;
    public Register registerScript;
    public Text feedbackText;

    void Start()
    {
        registerButton.onClick.AddListener(OnRegisterButtonClick);
    }

    void OnRegisterButtonClick()
    {
        string username = usernameField.text;
        string password = passwordField.text;
        string email = emailField.text;
        string playName = playNameField.text;

        registerScript.RegisterUser(username, password, email, playName);
    }
}
