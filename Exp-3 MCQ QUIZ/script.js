// script.js - MCQ Questions and Quiz Logic

// MCQ Questions
const quizData = [
    {
        question: "What does HTML stand for?",
        options: [
            "Hyper Text Markup Language",
            "High Text Machine Language",
            "Hyperlinks Text Mark Language",
            "Home Tool Markup Language"
        ],
        answer: 0
    },
    {
        question: "Which tag is used to create a hyperlink?",
        options: [
            "<a>",
            "<link>",
            "<href>",
            "<url>"
        ],
        answer: 0
    },
    {
        question: "Which language is used for styling web pages?",
        options: [
            "HTML",
            "CSS",
            "PHP",
            "Python"
        ],
        answer: 1
    },
    {
        question: "Which language is used for web page interactivity?",
        options: [
            "Java",
            "Python",
            "JavaScript",
            "C"
        ],
        answer: 2
    },
    {
        question: "Which HTML tag inserts an image?",
        options: [
            "<picture>",
            "<img>",
            "<image>",
            "<src>"
        ],
        answer: 1
    },
    {
        question: "Which CSS property changes text color?",
        options: [
            "font-color",
            "text-color",
            "color",
            "background"
        ],
        answer: 2
    },
    {
        question: "Which HTML tag creates a table row?",
        options: [
            "<td>",
            "<tr>",
            "<th>",
            "<table>"
        ],
        answer: 1
    },
    {
        question: "JavaScript is a ______ language.",
        options: [
            "Programming",
            "Markup",
            "Styling",
            "Database"
        ],
        answer: 0
    },
    {
        question: "Which symbol is used for ID selector in CSS?",
        options: [
            ".",
            "#",
            "*",
            "@"
        ],
        answer: 1
    },
    {
        question: "Which HTML tag is used for paragraph?",
        options: [
            "<p>",
            "<para>",
            "<h1>",
            "<text>"
        ],
        answer: 0
    },
    {
        question: "Which HTML tag creates a line break?",
        options: [
            "<br>",
            "<break>",
            "<lb>",
            "<hr>"
        ],
        answer: 0
    },
    {
        question: "Which input type hides password?",
        options: [
            "text",
            "password",
            "hidden",
            "email"
        ],
        answer: 1
    },
    {
        question: "Which CSS property changes background color?",
        options: [
            "bgcolor",
            "background-color",
            "background",
            "color"
        ],
        answer: 1
    },
    {
        question: "Which company developed JavaScript?",
        options: [
            "Microsoft",
            "Google",
            "Netscape",
            "Apple"
        ],
        answer: 2
    },
    {
        question: "Which method displays an alert box?",
        options: [
            "alert()",
            "msg()",
            "display()",
            "popup()"
        ],
        answer: 0
    },
    {
        question: "Which HTML tag creates an ordered list?",
        options: [
            "<ul>",
            "<ol>",
            "<li>",
            "<list>"
        ],
        answer: 1
    },
    {
        question: "PHP is mainly used for?",
        options: [
            "Database",
            "Styling",
            "Server-side scripting",
            "Operating System"
        ],
        answer: 2
    },
    {
        question: "Which database is commonly used with PHP?",
        options: [
            "Oracle",
            "MySQL",
            "MongoDB",
            "SQLite"
        ],
        answer: 1
    },
    {
        question: "AJAX stands for?",
        options: [
            "Asynchronous JavaScript and XML",
            "Advanced Java and XML",
            "Application Java XML",
            "Async Java Access"
        ],
        answer: 0
    },
    {
        question: "Which symbol is used for comments in JavaScript?",
        options: [
            "//",
            "<!-- -->",
            "##",
            "**"
        ],
        answer: 0
    }
];

// Variables
let currentQuestion = 0;
let score = 0;
let answered = false;

// DOM Elements
const questionElement = document.getElementById("question");
const optionsElement = document.getElementById("options");
const nextButton = document.getElementById("nextBtn");
const feedbackEl = document.getElementById("feedback");
const quizEl = document.getElementById("quiz");
const resultEl = document.getElementById("result");
const scoreEl = document.getElementById("score");

// Randomize Questions
quizData.sort(() => Math.random() - 0.5);

// Load Question
function loadQuestion() {
    // Reset state
    answered = false;
    feedbackEl.textContent = "";
    feedbackEl.className = "feedback-text";

    const current = quizData[currentQuestion];
    questionElement.textContent = (currentQuestion + 1) + ". " + current.question;
    optionsElement.innerHTML = "";

    current.options.forEach(function(option, index) {
        const button = document.createElement("button");
        button.textContent = option;
        button.classList.add("option");
        button.dataset.index = index;
        optionsElement.appendChild(button);

        button.onclick = function() {
            if (answered) return;
            selectOption(index);
        };
    });

    // Update next button text
    nextButton.textContent = currentQuestion === quizData.length - 1 ? "Finish" : "Next →";
}

function selectOption(index) {
    const current = quizData[currentQuestion];
    const allOptions = document.querySelectorAll(".option");
    const isCorrect = (index === current.answer);

    // Disable all buttons
    allOptions.forEach(function(btn) {
        btn.disabled = true;
    });

    // Mark selected
    allOptions.forEach(function(btn, i) {
        if (i === current.answer) {
            btn.classList.add("correct");
        }
        if (i === index && !isCorrect) {
            btn.classList.add("wrong");
        }
        if (i === index && isCorrect) {
            btn.classList.add("correct");
        }
    });

    // Update score and feedback
    if (isCorrect) {
        score++;
        feedbackEl.textContent = "✅ Correct!";
        feedbackEl.className = "feedback-text correct-fb";
    } else {
        feedbackEl.textContent = '❌ Incorrect. The correct answer is: "' + current.options[current.answer] + '"';
        feedbackEl.className = "feedback-text wrong-fb";
    }

    answered = true;
}

// Next Button
nextButton.onclick = function() {
    if (!answered) {
        feedbackEl.textContent = "⚠️ Please select an answer first!";
        feedbackEl.className = "feedback-text";
        return;
    }

    currentQuestion++;

    if (currentQuestion < quizData.length) {
        loadQuestion();
    } else {
        // Quiz completed
        quizEl.classList.add("hide");
        resultEl.classList.remove("hide");
        scoreEl.textContent = "Your Score: " + score + " / " + quizData.length;
    }
};

// Keyboard Support
document.addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        if (!resultEl.classList.contains("hide")) return;
        if (!quizEl.classList.contains("hide")) {
            nextButton.click();
        }
    }
    // Number keys 1-4 to select options
    if (!answered && !quizEl.classList.contains("hide")) {
        const num = parseInt(e.key);
        if (num >= 1 && num <= 4) {
            const btns = document.querySelectorAll(".option");
            if (btns[num - 1]) btns[num - 1].click();
        }
    }
});

// Start Quiz
loadQuestion();