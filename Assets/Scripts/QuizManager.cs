using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;
using System.Collections;
using System.Collections.Generic;
using TMPro;

public class QuizManager : MonoBehaviour
{
    private string getQuestionsUrl = "http://localhost/Game/Question/getQuestion.php"; // Thay thế bằng URL của bạn

    public TextMeshProUGUI questionText;
    public Button[] answerButtons;
    public TextMeshProUGUI timerText;
    public TextMeshProUGUI scoreText;


    private List<Question> questions;
    private int currentQuestionIndex;
    private float questionTime = 30f;
    private float timeRemaining;
    private int score;
    private bool answered;

    void Start()
    {
        StartCoroutine(GetQuestions());
    }

    private IEnumerator GetQuestions()
    {
        UnityWebRequest www = UnityWebRequest.Get(getQuestionsUrl);

        yield return www.SendWebRequest();

        if (www.result == UnityWebRequest.Result.ConnectionError || www.result == UnityWebRequest.Result.ProtocolError)
        {
            Debug.LogError(www.error);
        }
        else
        {
            questions = JsonUtility.FromJson<QuestionList>("{\"questions\":" + www.downloadHandler.text + "}").questions;
            StartGame();
        }
    }

    private void StartGame()
    {
        score = 0;
        currentQuestionIndex = 0;
        ShowQuestion();
    }

    private void ShowQuestion()
    {
        if (currentQuestionIndex < questions.Count)
        {
            Question question = questions[currentQuestionIndex];
            questionText.text = question.question;
            answerButtons[0].GetComponentInChildren<TextMeshProUGUI>().text = question.answer1;
            answerButtons[1].GetComponentInChildren<TextMeshProUGUI>().text = question.answer2;
            answerButtons[2].GetComponentInChildren<TextMeshProUGUI>().text = question.answer3;
            answerButtons[3].GetComponentInChildren<TextMeshProUGUI>().text = question.answer4;

            for (int i = 0; i < answerButtons.Length; i++)
            {
                answerButtons[i].onClick.RemoveAllListeners();
                if (i == question.correct_answer - 1)
                {
                    answerButtons[i].onClick.AddListener(() => Answer(true));
                }
                else
                {
                    answerButtons[i].onClick.AddListener(() => Answer(false));
                }
            }

            timeRemaining = questionTime;
            answered = false;
            StartCoroutine(Countdown());
        }
        else
        {
            EndGame();
        }
    }

    private IEnumerator Countdown()
    {
        while (timeRemaining > 0 && !answered)
        {
            timerText.text = "Time: " + timeRemaining.ToString("F0");
            yield return new WaitForSeconds(1f);
            timeRemaining--;
        }

        if (!answered)
        {
            Answer(false);
        }
    }

    private void Answer(bool isCorrect)
    {
        answered = true;

        if (isCorrect)
        {
            score += Mathf.CeilToInt(timeRemaining);
        }

        scoreText.text = "Score: " + score;
        currentQuestionIndex++;
        ShowQuestion();
    }

    private void EndGame()
    {
        // Hiển thị kết quả cuối cùng hoặc thực hiện các hành động kết thúc trò chơi
        questionText.text = "Chúc mừng bạn ghi được  " + score + "điểm";
        foreach (Button button in answerButtons)
        {
            button.gameObject.SetActive(false);
        }
    }

    [System.Serializable]
    public class Question
    {
        public int id;
        public string question;
        public string answer1;
        public string answer2;
        public string answer3;
        public string answer4;
        public int correct_answer;
    }

    [System.Serializable]
    public class QuestionList
    {
        public List<Question> questions;
    }
}

