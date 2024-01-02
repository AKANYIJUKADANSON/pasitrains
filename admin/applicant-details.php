<?php
session_start();
include('../inc/config.php');
// $conn = mysqli_connect('localhost', 'root', '', 'pasi');
$posted_reg_no = $_POST['reg_no'];

// Getting the data for the applicant
if (!empty($posted_reg_no)) {
    $get_applicant = "SELECT * FROM applications WHERE reg_no = '$posted_reg_no' ";
    $get_applicant_run = mysqli_query($conn, $get_applicant);
    $applicant = mysqli_fetch_assoc($get_applicant_run);

    // all the applicant's data
    $appFName = $applicant['firstName'];
    $appMName = $applicant['middleName'];
    $appLName = $applicant['lastName'];
    $appRegNo = $applicant['reg_no'];
    $appCourse = $applicant['course'];
    $courseDuration = $applicant['duration'];
    $startDate = $applicant['start_date'];
    $dob = $applicant['dob'];
    $gender = $applicant['gender'];
    $employer = $applicant['employer'];
    $country = $applicant['country'];
    $appCity = $applicant['city'];
    $appPostalAddress = $applicant['postalAddress'];
    $appProfilePicture = $applicant['profilePicture'];
    $appEmail = $applicant['email'];
    $appPhoneNo = $applicant['phone'];
    $appRegDate = $applicant['reg_date'];
    $applicationStatus = $applicant['applicationStatus'];
    $appEmailVerifStatus = $applicant['emailVerifStatus'];
    $approvedBy = $applicant['approvedBy'];

    // Change color according to status of registration and verification of email
    if ($appEmailVerifStatus == 1) {
        $verifStatus = "Verified";
        $verifStatusColor = "success";
    } else {
        $verifStatus = "Not Verified";
        $verifStatusColor = "danger";
    }

    if ($applicationStatus == 1) {
        $approvalStatus = "Approved";
        $approvalStatusColor = "success";
    } else {
        $approvalStatus = "Not Approved";
        $approvalStatusColor = "danger";
    }
}

?>

<html>

<body>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card text-secondary">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img style="height: 200px; width: 200px" src="../assets/uploads/<?= $applicant['profilePicture']; ?>" alt="Profile" class="rounded-circle img-profile">
                        <h3><?= $appFName; ?></h3>
                        <h3><?= $appMName . " " . $appLName; ?></h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">My Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Tab profile overview -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <div class="row d-flex">
                                    <div class="col-md-6 text-uppercase lh-lg my-4">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label "><b>Reg No.:</b></div>
                                            <div class="col-lg-9 col-md-7">
                                                <b class="text-secondary"><?= $appRegNo; ?></b>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>Mobile No:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $appPhoneNo; ?></b></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b data-toggle="tooltip" title="Date Of Birth">DOB:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $dob; ?></b></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>Gender:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $gender; ?></b></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>Email:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary text-lowercase"><?= $appEmail; ?></b></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-uppercase lh-lg my-4">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>Employer:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $employer; ?></b></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>Country:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $country; ?></b></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>City:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $appCity; ?></b></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label"><b>Address:</b></div>
                                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $appPostalAddress; ?></b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab edit profile -->
                            <div class="tab-pane fade profile-edit" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="" name="updateForm" enctype="multipart/form-data">

                                <input type="hidden" name="updateRegNo" value="<?=$applicant['reg_no'];?>">

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>

                                        <div class="col-md-8 col-lg-9">
                                            <img class="rounded-circle" src="../assets/uploads/<?= $applicant['profilePicture']; ?>" id="output" width="100" height="100" />

                                            <div class="pt-2">
                                                <input type="file" accept="image/*" onchange="loadFile(event)" name="profileImage">
                                                <script>
                                                    var loadFile = function(event) {
                                                        var image = document.getElementById('output');
                                                        image.src = URL.createObjectURL(event.target.files[0]);
                                                    };
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3">First Name</label>

                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="text" class="form-control" id="inputFirstName" name="firstName" value="<?= $applicant['firstName']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="text" class="form-control" id="inputMiddleName" name="middleName" value="<?= $applicant['middleName']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="text" class="form-control" name="lastName" value="<?= $applicant['lastName']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="date" class="form-control" id="inputDOB" name="date_of_birth" value="<?= $applicant['dob']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="inputGender" class="form-select" name="gender">
                                                <option class="text-secondary" value="<?= $applicant['gender']; ?>"><?= $applicant['gender']; ?></option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Employer</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="text" class="form-control" id="inputEmployer" name="employer" value="<?= $applicant['dob']; ?>">
                                        </div>
                                    </div>

                                    <br>
                                    <label for="country" class="form-label fs-3"><b>Address</b></label>
                                    <hr>


                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="country" class="form-select">
                                                <option class="text-secondary" value="<?= $applicant['country']; ?>"><span class="text-danger"><?= $applicant['country']; ?></span></option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-bissau">Guinea-bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                <option value="Korea, Republic of">Korea, Republic of</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macao">Macao</option>
                                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russian Federation">Russian Federation</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-leste">Timor-leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Viet Nam">Viet Nam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">City</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="text" class="form-control" id="inputCity" name="addressCity" value="<?= $applicant['city']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Postal Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="text" class="form-control" name="addressBox" value="<?= $applicant['postalAddress']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="email" class="form-control" id="inputEmail" name="useremail" value="<?= $applicant['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="text-secondary" type="tel" class="form-control" id="inputPhone" name="phone_number" value="<?= $applicant['phone']; ?>">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" name="update" class="btn btn-primary" value="Update">
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 my-4">
                <h4 class="text-uppercase"><b>Application Details</b></h4>
                <hr>
                <div class="row d-flex">
                    <div class="col-md-7 text-uppercase lh-lg pt-2" style="border-left: 4px solid blue;">
                        <div class="row">
                            <div class="col-lg-3 col-md-5 label "><b>Training In:</b></div>
                            <div class="col-lg-9 col-md-7">
                                <b class="text-secondary"><?= $appCourse; ?></b>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label"><b>Duration:</b></div>
                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $courseDuration; ?></b></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label"><b>Start Date:</b></div>
                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $startDate; ?></b></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label"><b>Applied On:</b></div>
                            <div class="col-lg-9 col-md-8"><b class="text-secondary"><?= $appRegDate; ?></b></div>
                        </div>
                    </div>

                    <div class="col-md-5 text-uppercase" style="border-left: 4px solid blue;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 label my-2"><b data-toggle="tooltip" title="Verification Status">Verification Status:</b></div>
                            <div class="col-lg-6 col-md-6 my-2"><b class="text-<?= $verifStatusColor; ?> "><?= $verifStatus; ?></b></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 label my-2"><b data-toggle="tooltip" title="Verification Status">Approval Status:</b></div>
                            <div class="col-lg-6 col-md-6 my-2"><b class="text-<?= $approvalStatusColor; ?> "><?= $approvalStatus; ?></b></div>


                        </div>

                        <div class="row col-12 my-2">
                            <?php if ($applicationStatus == 0) { ?>
                                <form action="applicants-list.php" method="post">
                                    <button type="submit" name="approve" class="btn btn-primary">Approve Application</button>
                                </form>

                            <?php } else {
                            ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 label my-2"><b>Approved By: </b></div>
                                    <div class="col-lg-6 col-md-6 my-2"><b class="text-primary"><?= $approvedBy; ?></b></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>