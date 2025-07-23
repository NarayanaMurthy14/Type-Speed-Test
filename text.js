let quoteText = "";
document.addEventListener("DOMContentLoaded", () => {
    let startTime, timerInterval;
    let typedChars = 0, correctChars = 0;

    function fetchQuote() {
    fetch("https://baconipsum.com/api/?type=meat-and-filler&paras=1&format=text")
        .then(res => res.text())
        .then(data => {
            quoteText = data.trim();
            document.getElementById("quote").innerText = quoteText; // Optional: keep hidden
            document.getElementById("highlighted-quote").innerHTML =
                quoteText.split('').map(ch => `<span class="pending">${ch}</span>`).join('');
        })
        .catch(() => {
            quoteText = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.";
            document.getElementById("highlighted-quote").innerHTML =
                quoteText.split('').map(ch => `<span class="pending">${ch}</span>`).join('');
        });
    }


    function startTyping() {
        if (!startTime) {
            startTime = new Date();
            timerInterval = setInterval(updateTimer, 1000);
        }
    }

    function updateTimer() {
        const elapsed = Math.floor((new Date() - startTime) / 1000);
        const remaining = 60 - elapsed;
        document.querySelector(".time").textContent = remaining;

        if (remaining <= 0) {
            clearInterval(timerInterval);
            document.getElementById("inputBox").disabled = true;

            const finalWPM = document.querySelectorAll(".metric-value")[0].textContent;
            const finalCPM = document.querySelectorAll(".metric-value")[1].textContent;
            const finalAccuracy = document.querySelectorAll(".metric-value")[2].textContent;

            submitScore(finalWPM, finalCPM, finalAccuracy);
        }

        updateMetricsAndHighlight();
    }

    function updateMetricsAndHighlight() {
    const typedText = document.getElementById("inputBox").value;
    const highlightBox = document.getElementById("highlighted-quote");

    typedChars = typedText.length;
    correctChars = 0;

    let html = "";
    for (let i = 0; i < quoteText.length; i++) {
        const char = quoteText[i];
        if (i < typedText.length) {
            if (typedText[i] === char) {
                html += `<span class="correct">${char}</span>`;
                correctChars++;
            } else {
                html += `<span class="incorrect">${char}</span>`;
            }
        } else {
            html += `<span class="pending">${char}</span>`;
        }
    }

    highlightBox.innerHTML = html;

    const elapsedTime = (new Date() - startTime); 
    const elapsedMinutes = elapsedTime / 60000;

    let wpm = 0, cpm = 0;
    if (elapsedMinutes >= 0.1) {  
        wpm = (typedText.trim().split(/\s+/).length / elapsedMinutes).toFixed(0);
        cpm = (typedChars / elapsedMinutes).toFixed(0);
    }

    const accuracy = ((correctChars / typedChars) * 100 || 0).toFixed(0);

    document.querySelectorAll(".metric-value")[0].textContent = wpm;
    document.querySelectorAll(".metric-value")[1].textContent = cpm;
    document.querySelectorAll(".metric-value")[2].textContent = accuracy;
    }

    function submitScore(wpm, cpm, accuracy) {
        fetch('../api/update_score.php', {
            method: 'POST',
            credentials: 'include', // ✅ Ensures session cookie is sent
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `wpm=${wpm}&cpm=${cpm}&accuracy=${accuracy}`
        })
        .then(res => res.text())
        .then(response => {
            alert("Test complete! " + response);
        })
        .catch(err => {
            console.error("Score update error:", err);
            alert("Failed to submit score.");
        });
    }


    fetchQuote();

    const typingBox = document.getElementById("inputBox");
    typingBox.addEventListener("input", () => {
        startTyping();
        updateMetricsAndHighlight();
    });

});
