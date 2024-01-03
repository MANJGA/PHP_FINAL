
function submitAnswer(questionId, selectedOption) {

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/api/submit-answer', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ question_id: questionId, selected_option: selectedOption })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const quizContainer = document.getElementById('quiz-container');

    quizContainer.addEventListener('click', function(event) {
        if (event.target.matches('.answer-button')) {
            // Prevent default form submission
            event.preventDefault();

            const questionId = event.target.dataset.questionId;
            const selectedOption = event.target.dataset.optionValue;

            // Call function to handle answer submission
            submitAnswer(questionId, selectedOption);
        }
    });

    function submitAnswer(questionId, selectedOption) {
        // Get CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/api/submit-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ question_id: questionId, selected_option: selectedOption })
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response, update UI with correct/incorrect feedback
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
