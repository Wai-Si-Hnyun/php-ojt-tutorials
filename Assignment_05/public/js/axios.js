const uploadStudentData = (data) => {
    const route = data.route;

    axios.post(route, {
        name: data.name,
        major_id: data.major_id,
        phone: data.phone,
        email: data.email,
        address: data.address
    })
    .then(function(res) {
        //Go to main page
        window.location.href = '/students';
    })
    .catch(function(err) {
        if (err.response.status === 422) {
            const errors = err.response.data.errors;

            //Display validation errors in UI
            displayValidationErrors(errors);
        } else {
            console.log(err);
        }
    })
}

const uploadMajorData = (name, route) => {

    axios.post(route, {
        'name': name
    })
    .then(function(res) {
        window.location.href = '/majors';
    })
    .catch(function(err) {
        if (err.response.status === 422) {
            const errors = err.response.data.errors;

            //Display validation errors in UI
            displayValidationErrors(errors);
        } else {
            console.log(err);
        }
    })
}

const deleteData = (e, id, model) => {
    e.preventDefault();

    const route = model === 'student' ? `/students/delete/${id}` : `/majors/delete/${id}`;

    if (confirmDelete()) {
        axios.delete(route)
            .then((res) => {
                const tr = document.querySelector(`table tbody tr[data-id="${id}"]`);
                if (tr) {
                    tr.remove();
                }
            })
            .catch((err) => {
                console.log(err);
            })
    }
}

const displayValidationErrors = (errors) => {
    //Clear any existing errors
    const inputs = document.querySelectorAll('.form-control, .form-select');

    for (const input of inputs) {
        input.classList.remove('is-invalid');
        if (input.nextElementSibling && 
            input.nextElementSibling.classList.contains('invalid-feedback')) {
            input.nextElementSibling.remove();
        }
    }

    //Apply new errors
    for (const field in errors) {
        const errorMessage = errors[field][0];
        const inputElement = document.querySelector(`#${field}`);

        if(inputElement) {
            inputElement.classList.add('is-invalid');

            const errorContainer = document.createElement('div');
            errorContainer.className = 'invalid-feedback';
            errorContainer.textContent = errorMessage;

            inputElement.insertAdjacentElement('afterend', errorContainer);
        } else {
            console.warn('Input element not found');
        }
    }
}

const confirmDelete = () => {
    return confirm('Are you sure to delete this item?');
}