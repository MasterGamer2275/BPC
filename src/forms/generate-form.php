 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dynamic Form Generation</title>
</head>
<body>

<div id="formContainer2"></div>

<script>
// Function to generate the form
function generateForm(formnumber) {
    // Get reference to the form container
    var formContainer = document.getElementById('formContainer2');

    // Create a new form element
    var formname = "sub-form" + formnumber;
    var form = document.createElement(formname);
    
    // Set form attributes like action, method, etc.
    form.setAttribute('action', '#');
    form.setAttribute('method', '#');

    // Create input fields
    var input1 = document.createElement('textarea');
    input1.setAttribute('type', 'text');
    input1.setAttribute('name', 'username');
    input1.setAttribute('placeholder', 'Username');

    var input2 = document.createElement('input');
    input2.setAttribute('type', 'password');
    input2.setAttribute('name', 'password');
    input2.setAttribute('placeholder', 'Password');

    var input3 = document.createElement('textarea');
    input3.setAttribute('name', 'message');
    input3.setAttribute('placeholder', 'Message');

    var input4 = document.createElement('input');
    input4.setAttribute('type', 'submit');
    input4.setAttribute('value', 'Submit');

    // Append input fields to the form
    form.appendChild(input1);
    form.appendChild(document.createElement('br')); // Line break
    form.appendChild(input2);
    form.appendChild(document.createElement('br')); // Line break
    form.appendChild(input3);
    form.appendChild(document.createElement('br')); // Line break
    form.appendChild(input4);

    // Append the form to the container
    formContainer.appendChild(form);
}

// Call the function to generate the form
generateForm();
</script>

</body>
</html>