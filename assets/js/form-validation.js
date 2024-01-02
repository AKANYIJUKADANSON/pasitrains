
// Application form validation
function validate(){
    var fname = document.appForm.firstName.value.replace(/[^a-zA-Z ]/g, '');
    var lname = document.appForm.lastName.value.replace(/[^a-zA-Z ]/g, '');
    var date_of_birth = document.appForm.date_of_birth.value;
    var gender = document.appForm.gender.value.replace(/[^a-zA-Z ]/g, '');
    var employer = document.appForm.employer.value.replace(/[^a-zA-Z0-9 _ ]/g, '');
    var country = document.appForm.country.value.replace(/[^a-zA-Z ]/g, '');
    var useremail = document.appForm.useremail.value.replace(/[^a-zA-Z0-9 @ . ]/g, '');
    var phone_number = document.appForm.phone_number.value.replace(/[^0-9 + ]/g, '');

    /**
     * .replace(/[^a-zA-Z ]/g, '') is a regex that will remove special characters
     * whatever is inside the [] will be matched otherwise, other characters will
     * not be returned 
     * So the regex matches any character that is not a lowercase or uppercase letter, 
     * digit or space, and the replace() method returns a new string with all of 
     * these characters removed from the original string.
     */
    // alert(phone_number);

    if(fname.length == ""){
        Swal.fire({
            title: "First name is required",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(lname.length == ""){
        Swal.fire({
            title: "Last name is required",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(date_of_birth.length == ""){
        Swal.fire({
            title: "Date of birth cannot be empty",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(gender.length == ""){
        Swal.fire({
            title: "Field Gender cannot be empty",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(employer.length == ""){
        Swal.fire({
            title: "Field employer cannot be empty",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(country.length == ""){
        Swal.fire({
            title: "Field country cannot be empty",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(useremail.length == ""){
        Swal.fire({
            title: "Email is required",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else if(phone_number.length == ""){
        Swal.fire({
            title: "Phone number is required",
            icon: "warning",
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: "#d33",
            });
        return false;
    }else{
        return true;
    }
}