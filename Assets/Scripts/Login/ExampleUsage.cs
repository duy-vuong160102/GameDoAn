using UnityEngine;
using UnityEngine.UI;

public class ExampleUsage : MonoBehaviour
{
    public UserInfoFetcher userInfoFetcher;
    public Text user;

    void Start()
    {
        string username = user.text; // Thay thế bằng username vừa nhập
        userInfoFetcher.FetchUserInfo(username);
    }
}

