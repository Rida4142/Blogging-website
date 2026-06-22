// quill.js object
const quill = new Quill('#editor', {
  modules: {
    toolbar: '#toolbar'
  },
  theme: 'snow',
  placeholder: '    Title is first line...'
});
// adding a event listener to submit the blog button
document.getElementById('b2').addEventListener('click',extract);
function extract() {

  // getting inner html of blog with quill object
  var editorContent = quill.root.innerHTML.trim();
  // getting the title (text of first tag)
  var firstTag = quill.root.firstChild;
  var firstTagText = firstTag ? firstTag.textContent || firstTag.innerHTML : 'Untitled';
  var titleText = firstTagText.trim();
  // creating a form (its hidden)
  var form = document.createElement('form');
  form.method = 'POST';
  form.action = 'submit_blog.php';
  // creating a text area and appending it to the form since we dont have access to quill text editor
  var content = document.createElement('textarea');
  content.name = 'blog_content';
  content.value = editorContent;
  form.appendChild(content);
  var title = document.createElement('input');
  title.name = 'blog_title';
  title.value = titleText;
  form.appendChild(title);
  document.body.appendChild(form);
  form.submit();
}