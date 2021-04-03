//require('./bootstrap');

let $contact_person = $('.row-contact-person.d-none')
    .remove()
    .clone(true)
    .removeClass('d-none'),

    $before_contact = $('#before-contact-person');


$('#add-contact-person').click(addContact);
$('.x-project').click(deleteProject);
$(document).on("click", ".x-contact-person", removeContact);

function addContact(e)
{
    e.preventDefault();
    $before_contact.after($contact_person.clone(true));
}

function removeContact(e)
{
    e.preventDefault();

    $(this).parents('.row-contact-person').remove();
}

function deleteProject(e)
{
    let $row = $(this).parents('tr');
    let id = $row.data('id');

    $.ajax({
        type: 'POST',
        url: '/project/' + id,
        data: $('#delete-project').serialize(),
        success: (r) => $row.remove(),
        //dataType: dataType
    });


}
