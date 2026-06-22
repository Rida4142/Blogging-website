// quill.js object
const quill = new Quill('#editor', {
    modules: {
        toolbar: '#toolbar'
    },
    theme: 'snow',
    placeholder: '    First line is the question? After that there is the answer....'
});

// Adding an event listener to submit the blog button
document.getElementById('b2').addEventListener('click', extract);

function extract() {
    // Getting the plain text content of the editor (without HTML)
    var editorContent = quill.getText().trim();

    // Splitting the content into lines (assuming each line is separated by a newline)
    var lines = editorContent.split('\n');

    // The first line is the question
    var faqQuestion = lines[0].trim();

    // The remaining lines are the answer
    var faqAnswer = lines.slice(1).join('\n').trim();

    // Creating a form (it's hidden)
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'submit_faq.php';

    // Creating a textarea for the question and appending it to the form
    var questionField = document.createElement('textarea');
    questionField.name = 'faq_question';
    questionField.value = faqQuestion;
    form.appendChild(questionField);

    // Creating a textarea for the answer and appending it to the form
    var answerField = document.createElement('textarea');
    answerField.name = 'faq_answer';
    answerField.value = faqAnswer;
    form.appendChild(answerField);

    // Append the form to the document and submit it
    document.body.appendChild(form);
    form.submit();
}
