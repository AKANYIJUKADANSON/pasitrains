<?php
session_start();
include('../inc/config.php');
// Get course id
if (isset($_POST['more_details'])) {
    $course_id = $_POST['course_id'];
    // echo $course_id;

    /**
     * Getting the initial so as to use it to get the dates table data
     */
    $course_initial = $_POST['course_initial'];
    // echo $course_initial;

    // Get dates table data
    $query_dates = "SELECT * FROM dates WHERE initial = '$course_initial' ";
    $query_dates_run = mysqli_query($conn, $query_dates);

    // Get the course details for specific course selected
    $query = "SELECT * FROM training_calendar WHERE code = $course_id";
    $query_run = mysqli_query($conn, $query);

    $rows = mysqli_fetch_assoc($query_run);
} else {
    // echo "No course was selected";
    $_SESSION['status'] = "Please select a course of choice to proceed";
?>
    <script>
        alert("No course was selected, Please select a course to proceed");
        window.location.href = "training-calendar.php";
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PASI|Course Details</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include('../inc/navbar.php'); ?>

    <!-- ==================End of hero div================== -->
    <div class="row mt-4 mx-1">
        <!-- ------------------------______________________
                                    |                       |
                                    |   Left side columns   |
                                    |                       |
                                    |_______________________| ---------------------------- -->

        <div class="col-lg-8 pe-5 mb-4">

            <h1 class="about-right-heading my-4 text-primary"><?= $rows['training']; ?> (<?= $rows['initial']; ?>)</h1>

            <div class="row">
                <img style="height: 400px;" src="../assets/img/training/<?= $rows['image']; ?>" alt="" srcset="">


                <div class="dates">
                    <table width="100%" class="table table-striped datatable mt-5">
                        <thead>
                            <tr>
                                <th>Dates</th>
                                <th>Location</th>
                                <th>Fees($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($dates = mysqli_fetch_array($query_dates_run)) { ?>
                                <tr>

                                    <td><?= $dates['date']; ?></td>
                                    <td><?= $dates['location']; ?></td>
                                    <td><?= $dates['fees']; ?></td>


                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="my-4 about-details">
                <h3><b>Introduction</b></h3>
                <p><?= $rows['introduction']; ?></p>
            </div>

            <div>
                <div class="mt-2">

                    <?php if ($course_initial == "IMRMSO") { ?>
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>
                            <ul type="square">
                                <li>Create information and documentation procedures and requirements in SharePoint.</li>
                                <li>Understand Information Management in SharePoint and Office 365</li>
                                <li>Recognize Effective Information Architecture for SharePoint and Office 365 </li>
                                <li>Acquire the knowledge on how to manage email.</li>
                                <li>Understand the relation between records management and the cloud</li>
                                <li>Apply Privacy and data protection rules in SharePoint</li>
                                <li>Recognize the way to implement decommissioning of legacy systems and user information</li>
                                <li>Prepare Business and functional requirements for a digital record-keeping solution</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "RMC") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR Records Management Conference -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>
                            <p class="mt-4"><b>By the end of the course, participants will be able to:</b></p>
                            <ul type="square">
                                <li>Design a record management plan.</li>
                                <li>Implement a record management system.</li>
                                <li>Learn about the record management best practices.</li>
                                <li>Undertake recordkeeping analysis for an organization.</li>
                                <li>Understand monitoring and controlling of a record management system. </li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "PSAS") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR Professional Skills for Administrators & Secretaries -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Apply the skills and attributes of a first-class office professional in your workplace</li>
                                <li>Present yourself more confidently</li>
                                <li>Communicate effectively with managers, colleagues and all organisational </li>
                                <li>Handle the difficulties and pressures of working in a modern office</li>
                                <li>Prioritise, plan, and manage time more efficiently</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "ABCM") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR Advanced Budgeting and Cost Management -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Refine costing and budgeting terminology used in business</li>
                                <li>Understand the importance of a well-defined costing and budgeting processy</li>
                                <li>Determine full costs of outputs for the goods and services provided</li>
                                <li>Master traditional techniques and recent best practices on budgeting / cost managemen</li>
                                <li>Link finance and operation for budgeting purposes and strategy execution</li>
                                <li>Learn how to build a comprehensive performance measurement system</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "TRM") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR Treasury and Risk Management -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Manage Cash, Liquidity & Working Capital to reduce finance costs and improve returns</li>
                                <li>Recommend appropriate Methods of Short-term and Long-term Finance</li>
                                <li>Evaluate Capital Investment Opportunities</li>
                                <li>Determine and implement the company's Risk Management Strategy</li>
                                <li>Recommend Hedging and Risk Management Decisions</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "AOMEAS") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR AOMEAS -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Recognise how to prioritise and cope with multiple tasks</li>
                                <li>Develop the skills necessary to plan, make effective decisions and solve problems and handle pressure</li>
                                <li>Apply practical techniques to improve communications skills</li>
                                <li>Understand how to manage challenging behaviours</li>
                                <li>Apply assertiveness to be more effective in the workplace</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "STM") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR STM -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Understand the mechanisms to define talent, as well as manage your talent and high potential</li>
                                <li>Develop key strategies to optimize your talent and high potential employees</li>
                                <li>Engage and employ robust talent strategies within the complex multi-discipline industries</li>
                                <li>Produce develops effective and functional succession planning strategies</li>
                                <li>Lead and manage OCR (Organisational Capability Review) meetings to ensure proactive succession for sustained growth</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>

                    <?php } elseif ($course_initial == "AEDMS") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR AEDMS -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Manage/ control documents, including folders and forms, reduce document distribution costs - no more paper</li>
                                <li>Distribute and view documents costs - no more paper</li>
                                <li>Scan, OC, index, and archive paper documents</li>
                                <li>Automate other office functions that involve workflows and electronic mail</li>
                                <li>Address requirements of ISO 9000 and other regulatory agencies</li>
                                <li>Understand different technologies involved in EDMS</li>
                                <li>Get hands-on training on some EDMS products</li>
                                <li>Evaluate merging standards</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>

                    <?php } elseif ($course_initial == "ERAM") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR AEDMS -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Create a strategic plan for a records improvement process</li>
                                <li>Align the records management program to the corporate goals and objectives</li>
                                <li>Provide input into the Enterprise Content Management initiatives for their company</li>
                                <li>Prepare their company for Information Governance, beyond IT Governance</li>
                                <li>Assist their company in balancing the needs for Privacy versus Accessibility of records</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } elseif ($course_initial == "EDMS") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR AEDMS -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Create a strategic plan for a records improvement process</li>
                                <li>Align the records management program to the corporate goals and objectives</li>
                                <li>Provide input into the Enterprise Content Management initiatives for their company</li>
                                <li>Prepare their company for Information Governance, beyond IT Governance</li>
                                <li>Assist their company in balancing the needs for Privacy versus Accessibility of records</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>

                    <?php } elseif ($course_initial == "IFRS") { ?>
                        <!-- OBJECTIVES AND GENERAL NOTES FOR AEDMS -->
                        <div class="obj">
                            <h3><b><i class="bi bi-check-square me-3 text-danger"></i>Conference Objectives</b></h3>

                            <ul type="square">
                                <li>Describe the setting process in IFRS and list the currently available standards</li>
                                <li>Explain the most recent updates on existing IFRS and evaluate the effect of newly issued standards on their organization</li>
                                <li>Understanding the financial statement</li>
                                <li>Determine the correct presentation and minimum disclosure for components of statements of financial position, statements of comprehensive income, statements of owners' equity, and statements of cash flows in accordance with IFRS</li>
                                <li>Appraise and properly account for transactions affecting current assets and liabilities, noncurrent assets and liabilities, and revenues and expenses in accordance with IFRS</li>
                                <li>Use professional judgment in applying IFRS for matters relating to non recurrent business transactions</li>
                            </ul>
                        </div>
                        <div class="genNotes mt-4">
                            <h3><b><i class="bi bi-journals me-3 text-danger"></i>General Notes</b></h3>
                            <ol type="square">
                                <li>This course is delivered by our seasoned trainers who have vast experience as expert professionals in the respective fields of practice. The course is taught through a mix of practical activities, theory, group works and case studies.</li>
                                <li>Training manuals and additional reference materials are provided to the participants.</li>
                                <li>Upon successful completion of this course, participants will be issued with a certificate.</li>
                                <li>We can also do this as tailor-made course to meet organization-wide needs. Contact us to find out more: trainings@pasinformation.com/pasinformationafrica@gmail.com.</li>
                                <li>The training fee covers tuition fees, training materials, lunch, and training venue.Accommodation and airport transfer are arranged for our participants upon request.</li>
                                <li>Payment should be sent to our bank account before start of training and proof of payment sent to: trainings@pasinformation.com/pasinformationafrica@gmail.com </li>
                            </ol>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- ------------------------_______________________
                                    |                       |
                                    |   Right side columns  |
                                    |                       |
                                    |_______________________| ---------------------------- -->
        <div class="col-lg-4">
            <div class="results">
                <div class="row">
                    <h3 class="mt-4"><b><i class="bi bi-people-fill me-3 text-danger"></i>Who should attend?</b></h3>
                    <p><?= $rows['target_audience']; ?></p>
                </div>
                <div class="row">
                    <h3 class="mt-4"><b>Course Outline</b></h3>
                    <div class="mt-2">
                        <?php if ($course_initial == "IMRMSO") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Records Management as a Business Enabler</b></p>
                                    <ul type="square">
                                        <li>Enterprise Content Management through the Record Life Cycle</li>
                                        <li>Record Capture</li>
                                        <li>Digital Records</li>
                                        <li>Paper Records</li>
                                        <li>Record Retention and Disposition</li>
                                        <li>Records Management and the Cloud</li>
                                    </ul>
                                </div>
                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Records and Document Management in SharePoint and Office 365</b></p>
                                    <ul type="square">
                                        <li>SharePoint Online Architecture</li>
                                        <li>Configuring SharePoint</li>
                                        <li>Site Administration</li>
                                        <li>Search Settings in SharePoint</li>
                                    </ul>
                                </div>
                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Office 365</b></p>
                                    <ul type="square">
                                        <li>Office 365 and the Client Device</li>
                                        <li>Office 365 Supportability</li>
                                        <li>Architecture of OneDrive for Business</li>
                                        <li>Change Management in Office 365</li>
                                        <li>Data Protection in Office 365</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day4">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Content Migration to SharePoint</b></p>
                                    <ul type="square">
                                        <li>Migration Phases</li>
                                        <li>Requirements (Discovery)</li>
                                        <li>Preliminary Design (Content Inventory)</li>
                                        <li>Final Design</li>
                                        <li>Test Phase</li>
                                        <li>Go Live Phase</li>
                                        <li>Migration Scenarios</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day5">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Managing Governance, Security, and Compliance with SharePoint</b></p>
                                    <ul type="square">
                                        <li>Service Assurance with SharePoint</li>
                                        <li>Managing Permissions in SharePoint</li>
                                        <li>Designing User Experience with SharePoint</li>
                                        <li>Select and Configure Information Protection Tools with SharePoint</li>
                                        <li>eDiscovery Requests Compliance in SharePoint</li>
                                        <li>GDPR and other Audit Tools for SharePoint</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "RMC") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Records Management Fundamentals</b></p>
                                    <ul type="square">
                                        <li>Introduction to records</li>
                                        <li>Records content context and structure</li>
                                        <li>Record management</li>
                                        <li>Records management regulatory environment</li>
                                        <li>Record management system characteristics</li>
                                        <li>Record management system components</li>
                                    </ul>
                                </div>
                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Record Management Process</b></p>
                                    <ul type="square">
                                        <li>Identification of documents to be captured as records</li>
                                        <li>Lifecyle of records</li>
                                        <li>Record life cycle management best practices</li>
                                        <li>Records disposal implementation</li>
                                        <li>Records management process documentation</li>
                                    </ul>
                                </div>
                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Records Management Policy & Control</b></p>
                                    <ul type="square">
                                        <li>Records management policy objectives</li>
                                        <li>Responsibilities of Record management</li>
                                        <li>Record management policy Key provisions</li>
                                        <li>Training and Competence</li>
                                        <li>Policy and procedures that protect important documents</li>
                                        <li>Methods of protecting records</li>
                                        <li>Vital documents protection plan implementation</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day4">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Electronic Records Management</b></p>
                                    <ul type="square">
                                        <li>Electronic record types</li>
                                        <li>Introducing Electronic Records Management</li>
                                        <li>ERM management challenges</li>
                                        <li>Electronic Recordkeeping System (ERKS)</li>
                                        <li>Implementation issues of ERM and ERKS</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day5">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Records Management Standards</b></p>
                                    <ul type="square">
                                        <li>ISO 15489</li>
                                        <li>ISO 23081</li>
                                        <li>ISO 30300</li>
                                        <li>ISO 30301</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "PSAS") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Competencies and Time Management</b></p>
                                    <ul type="square">
                                        <li>Assessing prior Skills and Knowledge</li>
                                        <li>Competencies Required for Excellence as an Office Professional</li>
                                        <li>Perceptionas, Attitudes and Beliefs - How they affect Performance</li>
                                        <li>aLearning Styles / Thinking Styles - Your Strengths and Weaknesses</li>
                                        <li>Time Management Skills</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Organizing and Planning</b></p>
                                    <ul type="square">
                                        <li>Goal Setting including Setting SMART Objectives</li>
                                        <li>Planning</li>
                                        <li>Mind Mapping</li>
                                        <li>Problem Solving and Decision Making</li>
                                        <li>Managing Meetings</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Communication Skills</b></p>
                                    <ul type="square">
                                        <li>Understanding Assertive Communication</li>
                                        <li>Dealing with Conflict and Aggression</li>
                                        <li>Listening Skills</li>
                                        <li>Questioning Skills</li>
                                        <li>Body Language and Its Importance in Building Effective Relationships</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Team Orientation</b></p>
                                    <ul type="square">
                                        <li>Conflict Management and Resolution</li>
                                        <li>Dealing with Difficult People</li>
                                        <li>Managing Upwards</li>
                                        <li>Workplace Stress Management</li>
                                        <li>Working Effectively as Part of a Team</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Presentation Skills</b></p>
                                    <ul type="square">
                                        <li>Telephone Skills</li>
                                        <li>Writing Skills</li>
                                        <li>Email Etiquette</li>
                                        <li>Presentation Skills</li>
                                        <li>Review of the Week</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "ABCM") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: The Relevance of Budgeting and Cost Management within Strategy Execution</b></p>
                                    <ul type="square">
                                        <li>The Link between Strategy, Planning, Budgeting and Cost Management</li>
                                        <li>Why Budgeting and Costing are so important to manage your company?</li>
                                        <li>Towards a Cross-functional Process-view of the Organization</li>
                                        <li>Financial vs. Managerial Accounting (Where you get information for decisionmaking)</li>
                                        <li>Understand your Processes: Integrating Financial and Non-financial Aspects</li>
                                        <li>Identify and Discuss the Key issues in terms of Budget / Costing for your own Organization</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: The Budgeting Framework and its Role within the Management Process</b></p>
                                    <ul type="square">
                                        <li>The Role of Budgeting within Management Accounting</li>
                                        <li>The Value of Budgeting in your Company</li>
                                        <li>Behavioral Implications of Budgeting</li>
                                        <li>Key Concepts and Terminology</li>
                                        <li>Advantages and Disadvantages: Critical issues to be Discussed</li>
                                        <li>Overview on the Financial Statements - Balance sheet, Income statement and Cash-Flow</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Cost Management for Budgeting Purposes</b></p>
                                    <ul type="square">
                                        <li>Cost Concepts and Terminology</li>
                                        <li>Different Costs for Different Purposes</li>
                                        <li>Fixed vs. Variable Costs: The Cost-Volume-Profit Analysis Model</li>
                                        <li>Contribution Margin Analysis</li>
                                        <li>Manufacturing vs. Non-manufacturing Costs</li>
                                        <li>Period vs. Product Costs: Inventory Evaluation and Control</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Traditional vs. Advanced Techniques in Cost-control</b></p>
                                    <ul type="square">
                                        <li>Under-costing and Over-costing: The Consequences for Profitability</li>
                                        <li>How to refine a Costing System?</li>
                                        <li>Indirect vs. Direct costs: Traditional Cost Allocations Systems vs. Activity-Based Costing</li>
                                        <li>Cost Drivers: Linking Resources, Activities and Management</li>
                                        <li>Introducing Activity-Based Budgeting (ABB) and Management (ABM)</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Broadening the Performance Measurement Systems</b></p>
                                    <ul type="square">
                                        <li>Shortcomings of Traditional Approaches to Budgeting and Performance Measurement</li>
                                        <li>Need to Link Financial to Operational Issues</li>
                                        <li>Recent Best Practices: The Balanced Scorecard and Six-sigma</li>
                                        <li>Financial Perspective and Customer Perspective</li>
                                        <li>Internal Business Process Perspective and Learning & Growth Perspective</li>
                                        <li>Developing and Adapting the Scorecard</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "TRM") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: The Role of Treasury Management - An Overview</b></p>
                                    <ul type="square">
                                        <li>The Role & Scope of Treasury Management</li>
                                        <li>Operation & Location of a Treasury Department - <i>Cost or Profit Centre; Centralised or Decentralised</i></li>
                                        <li>Cash & Liquidity Management</li>
                                        <li>Working Capital Management</li>
                                        <li>Capital / Finance Management</li>
                                        <li>Risk Management</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Cash & Liquidity Management - A Detailed Analysis</b></p>
                                    <ul type="square">
                                        <li>Cash Forecasts: Role & Preparation</li>
                                        <li>Investment of Cash Surpluses to Maximize Return</li>
                                        <li>Meeting Cash Calls and Short-Term Cash Shortages / Short Term Finance</li>
                                        <li>Working Capital Management - Determining the Optimum Level</li>
                                        <li>Multi-national & Group Cash Management</li>
                                        <li>Cash Budgets: Process & Control</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Financing and Capital Management</b></p>
                                    <ul type="square">
                                        <li>Strategic Objectives: Consolidation, Growth, M & A; Joint Ventures, Diversification etc</li>
                                        <li>DFinancing Strategic Objectives / Long Term Finance <i>(Public & Private Equity v Buyer & Supplier Debt)</i></li>

                                        <li>Optimizing the Capital Structure to Minimize the Cost of Capital (WACC)</li>
                                        <li>The Capital Asset Pricing Model (CAPM)</li>
                                        <li>Capital Investment Appraisal - <i>NPV; IRR, Payback</i></li>
                                        <li>Capital Rationing: Internal & External</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Risk Management</b></p>
                                    <ul type="square">
                                        <li>Identifying Risks and Uncertainties - <i>Internal & External; Financial & NonFinancial</i></li>
                                        <li>Measuring Risk - <i>Volatility; Variance; Standard Deviation; Probability; Value at Risk</i></li>
                                        <li>Determining the Risk Management Strategy - Assessing Impact and Probability</li>
                                        <li>The 4 T's - Tolerate; Terminate; Transfer; Treat</li>
                                        <li>Internal Controls & Internal Auditing</li>
                                        <li>Credit & Counterparty Risk Management</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Currency, Interest Rate & Commodity (Oil Price) Risk Management</b></p>
                                    <ul type="square">
                                        <li>Forward Contracts and Forward Rate Agreements</li>
                                        <li>Options - Calls & Puts; European & American</li>
                                        <li>Futures - Market Correlation; Margin Payments, etc</li>
                                        <li>Swaps - Currency & Interest Rate Risk and Benefits</li>
                                        <li>Foreign Currency Accounts Other Internal Methods / Tactics</li>
                                        <li>Foreign Currency Borrowing</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "ACG") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: The Corporate Governance Requirements</b></p>
                                    <ul type="square">
                                        <li>Key Aspects of Corporate Governance</li>
                                        <li>Governance Assessment Techniques</li>
                                        <li>The Business Environment</li>
                                        <li>Analysing and Assessing the Effectiveness of Governance Controls</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Preparing for the Governance Audit</b></p>
                                    <ul type="square">
                                        <li>Scoping a Governance Audit</li>
                                        <li>The Need for Governance Audit of the Board</li>
                                        <li>The 15 Key Governance Board Risks to be Reviewed</li>
                                        <li>Auditing the Overall Risk Management Process</li>
                                        <li>Evaluating Risk Appetite</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Reviewing the Key Aspects of Governance</b></p>
                                    <ul type="square">
                                        <li>Auditing the Audit Committee Process</li>
                                        <li>Auditing Reputation</li>
                                        <li>Corporate Social Responsibility</li>
                                        <li>Sustainability and Environment Audit</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Auditing Other Key Governance Activities</b></p>
                                    <ul type="square">
                                        <li>Auditing IT Governance</li>
                                        <li>Auditing Joint Ventures and Partnerships</li>
                                        <li>Auditing Joint Ventures and Partnerships</li>
                                        <li>Reviewing a Current JV or Partnership</li>
                                        <li>Auditing Business Continuity Planning</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Auditing Technology Governance and Regulatory Compliance</b></p>
                                    <ul type="square">
                                        <li>Reviewing Key Controls Over Technology</li>
                                        <li>Assessing Management Information Governance</li>
                                        <li>Communication Internally and Externally</li>
                                        <li>Ongoing Evaluations to Ascertain Whether the Components of Internal Control
                                            are Present and Functioning</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "AOMEAS") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Taking Control of Your Work Life</b></p>
                                    <ul type="square">
                                        <li>Understanding and Clarifying Purpose, Vision, and Mission</li>
                                        <li>External and Internal Customer Service</li>
                                        <li>The Secret to Working Smarter rather than Harder</li>
                                        <li>Controlling, Prioritising and Organising Your Work</li>
                                        <li>Gaining an insight into your Strengths and Weaknesses</li>
                                        <li>Making Your Office User-friendly and Efficient</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Essential Administrative Skills</b></p>
                                    <ul type="square">
                                        <li>Mind Mapping Techniques</li>
                                        <li>Right Brain / Left Brain Theory</li>
                                        <li>Managing Larger Projects to Meet Deadlines</li>
                                        <li>Planning and Problem-Solving Skills</li>
                                        <li>Managing Meetings Effectively</li>
                                        <li>Working with more than One Manager</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Vital Communication Skills</b></p>
                                    <ul type="square">
                                        <li>Communication Styles and When to Use Them</li>
                                        <li>Communicating with Confidence</li>
                                        <li>Win-Win Conflict Resolution</li>
                                        <li>Understanding and using Body Language</li>
                                        <li>Understanding Gender Differences in Communication</li>
                                        <li>Understanding Different Personality Types and How to Deal with them</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Developing as a Professional</b></p>
                                    <ul type="square">
                                        <li>Listening Skills - <i>seek first to understand then to be understood</i></li>
                                        <li>Creating a Professional Image</li>
                                        <li>Leadership Skills</li>
                                        <li>How to Make Presentations with Confidence and Power</li>
                                        <li>Painless Methods for Giving Corrective Feedback</li>
                                        <li>Best Practices for Delivering Positive Feedback</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Self-Empowerment and Self-Management</b></p>
                                    <ul type="square">
                                        <li>Understanding the Main Causes of Stress</li>
                                        <li>How to Build Self-confidence and Strengthen the Ability to Respond to Difficult Situations</li>
                                        <li>The Essential Skills of Emotional Intelligence</li>
                                        <li>Using Emotional Intelligence at Work</li>
                                        <li>Becoming a more Proactive, Responsible and Self-aware Person</li>
                                        <li>Continuing Professional Development - <i>where to go from here?</i></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "STM") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Defining and Attracting Talent</b></p>
                                    <ul type="square">
                                        <li>Talent management - Overview and background</li>
                                        <li>Talent / high potential - Defining the criteria</li>
                                        <li>Talent options - Recruit external or grow internal</li>
                                        <li>Aligning talent management with organisational development (OD) and business strategy</li>
                                        <li>Utilising workforce planning and other sources of data</li>
                                        <li>Attraction strategies - Use of media and other channels</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Creating Your High Potential Talent Pool</b></p>
                                    <ul type="square">
                                        <li>Talent management models, grading, and structures</li>
                                        <li>Assessment methods and systems - Use of Psychometric / Behavioural / Competency Frameworks</li>
                                        <li>Conducting an effective talent gap analysis</li>
                                        <li>ABC model of potential - Getting the criteria right</li>
                                        <li>Managing Meetings Effectively</li>
                                        <li>Using the 9 Box Grid, and other methods to create your talent and high potential matrix</li>

                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Developing Your Talent and High Potentials</b></p>
                                    <ul type="square">
                                        <li>Defining high calibre development options</li>
                                        <li>Conducting an effective performance discussion</li>
                                        <li>Creating individual development plans</li>
                                        <li>Powerful feedback techniques: Motivating individuals to achieve higher potential</li>
                                        <li>Coaching for success</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Retaining and Sustaining Your Talent and High Potentials</b></p>
                                    <ul type="square">
                                        <li>Career paths - Guidance for growth</li>
                                        <li>Using mentoring programmes to develop and retain your talent</li>
                                        <li>Reward strategies - Intrinsic and extrinsic incentives to motive your talent</li>
                                        <li>Managing expectations and delivering workable outcomes</li>
                                        <li>Growth rotation development (assignments, experience strategies)</li>
                                        <li>Creating a sustainable talent pipeline</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Strategic Succession Planning and Organisational Capability Review</b></p>
                                    <ul type="square">
                                        <li>Defining your bench strength</li>
                                        <li>Succession planning and the OCR process</li>
                                        <li>Conducting effective calibration meetings</li>
                                        <li>Formulating a strategic talent plan for the organization in-line with the business strategy</li>
                                        <li>Communicating the strategy to the board and the company</li>
                                        <li>Conclusion and review</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "AEDMS") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Introduction</b></p>
                                    <ul type="square">
                                        <li>EDMS - what is it and Benefits</li>
                                        <li>The paper floods</li>
                                        <li>The paperless office</li>
                                        <li>Document capture</li>
                                        <li>Scanning of documents</li>
                                        <li>OCR and image processing</li>
                                        <li>Indexing, archiving and retrieval</li>
                                        <li>Demonstration</li>
                                        <li>Word processors/spreadsheets</li>
                                        <li>Forms</li>
                                        <li>Document Management</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Document Control:</b></p>
                                    <ul type="square">
                                        <li>Revisions/versions/histories</li>
                                        <li>Audit trails</li>
                                        <li>Reports</li>
                                        <li>Demonstration</li>
                                        <li>Forms Management</li>
                                        <li>Creating forms</li>
                                        <li>Filling and saving forms/data</li>
                                        <li>Document Distribution: Workflow Management</li>
                                        <li>Creations</li>
                                        <li>Applications</li>
                                        <li>Tracking/closure</li>
                                        <li>Filling and saving forms/data</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Document Distribution: Workflow Management:</b></p>
                                    <ul type="square">
                                        <li>Applications</li>
                                        <li>Creations</li>
                                        <li>Tracking/closure</li>
                                        <li>Document Distribution: Electronic Mail: Concepts and Demonstration</li>
                                        <li>Document Browsing</li>
                                        <li>Navigation</li>
                                        <li>Application/independent viewers</li>
                                        <li>Annotation/sticky/notes/red/lining</li>
                                        <li>ISO 9000 & others Regulatory Requirements</li>
                                        <li>System Architectures & Platforms: LANs & WANs and Client-Server Architectures</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Technology Options:</b></p>
                                    <ul type="square">
                                        <li>Encryption</li>
                                        <li>Authoring Systems</li>
                                        <li>Card/folio-based systems</li>
                                        <li>Types of Documentation Systems</li>
                                        <li>Implementing EDMS</li>
                                        <li>Off - the- shelf VS Customs systems</li>
                                        <li>Allocating resources</li>
                                        <li>EDMS management</li>
                                        <li>Updating system</li>
                                        <li>Future topics</li>
                                        <li>Documents on demand</li>
                                        <li>Multimedia documents</li>
                                        <li>Process Context Diagram- Document Management</li>
                                        <li>Process flow- Document management</li>
                                        <li>Role and responsibilities- Document management</li>
                                        <li>Potential process measurements (KPIs)</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Creating Backups and Restoring:</b></p>
                                    <ul type="square">
                                        <li>Top Document Management Software Products</li>
                                        <li>Best- practice in document management procedures, based on ISO standards Document Creation Templates</li>
                                        <li>Multiple Security Levels: Case Study</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "ERAM") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: : Introduction to Electronic Document Management & Document Lifecycle</b></p>
                                    <ul type="square">
                                        <li>Digitalized information management</li>
                                        <li>Concept and general principles of EDM</li>
                                        <li>Purpose and Importance of EDM</li>
                                        <li>Differences between RMS (Records management system) and EDM</li>
                                        <li>Challenges of EDMS systems</li>
                                        <li>Benefits and good practices in using EDM</li>
                                        <li>Creation</li>
                                        <li>Distribution and use</li>
                                        <li>Disposition</li>
                                        <li>Archiving</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Electronic Recordkeeping & Elements of Effective Records Management System</b></p>
                                    <ul type="square">
                                        <li>Electronic recordkeeping vs electronic record management</li>
                                        <li>Objectives of electronic recordkeeping</li>
                                        <li>Integration of ERK system with other IT systems</li>
                                        <li>Critical success factors for implementation of ERK system</li>
                                        <li>Records inventory</li>
                                        <li>Retention scheduling</li>
                                        <li>Records storage & conversion</li>
                                        <li>Vital Records disposition</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Classification, Indexing and Metadata Management</b></p>
                                    <ul type="square">
                                        <li>Designing a records classification System</li>
                                        <li>Types of classification schemes</li>
                                        <li>Attributes of a good filing system</li>
                                        <li>Importance of metadata</li>
                                        <li>Uses and sources</li>
                                        <li>Methods for collecting and applying metadata</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Evaluation, Planning Implementation & Implementation Standards of an ERM system</b></p>
                                    <ul type="square">
                                        <li>ERM needs assessment</li>
                                        <li>Data collection from different users</li>
                                        <li>Data analysis and use in ERM planning</li>
                                        <li>Records Management integration to organization information management strategy</li>
                                        <li>Planning for cultural change associated with ERM</li>
                                        <li>Determining end users' roles in ERM system</li>
                                        <li>Planning for resources in ERM implementation</li>
                                        <li>Components of an ERM system</li>
                                        <li>Solution options for information and records management</li>
                                        <li>Designing an ERM system</li>
                                        <li>Steps to implement an effective ERM program</li>
                                        <li>Developing information governance strategy</li>
                                        <li>Integrating people, processes, and technologies</li>
                                        <li>International documentation integration regulations and requirements</li>
                                        <li>Electronic record management policy</li>
                                        <li>EDMS case study reports by Doculabs and ISO on ERM, EDM, and ECM systems</li>
                                        <li>Control of documents and management</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Disaster Management, Monitoring, Auditing, Security and Control in ERM</b></p>
                                    <ul type="square">
                                        <li>Types of disasters, hazards, and risks in ERM</li>
                                        <li>Disaster risk planning</li>
                                        <li>Development of policy, procedures for disaster risk management</li>
                                        <li>Records protection method</li>
                                        <li>Quality management requirements</li>
                                        <li>Conducting regular reviews of records management policy, plan, system, and guidelines</li>
                                        <li>Monitoring compliance to records management guidelines</li>
                                        <li>Change management in organization records management policy</li>
                                        <li>Document security</li>
                                        <li>Multiple security levels</li>
                                        <li>Encryption</li>
                                        <li>Authentication and authoring systems</li>
                                        <li>Backups and document restoration</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "EDMS") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Introduction on EDMS:</b></p>
                                    <ul type="square">
                                        <li>What is it and benefits?</li>
                                        <li>Introduce Engineering EDMS key concepts and drivers</li>
                                        <li>The paper floods</li>
                                        <li>The paperless Office</li>
                                        <li>Document Management policies and procedures</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: EDMS Components and Document Capture, Distribution, and Browsing:</b></p>
                                    <ul type="square">
                                        <li>Scanning of documents</li>
                                        <li>OCR and image processing</li>
                                        <li>Demonstration</li>
                                        <li>Indexing, archiving and retrieval</li>
                                        <li>Document capture</li>
                                        <li>Strategic Planning and Management for Records and Archive Services</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Strategy and Understanding Key Elements:</b></p>
                                    <ul type="square">
                                        <li>Document and records management strategy</li>
                                        <li>Information governance</li>
                                        <li>Understanding the terminology</li>
                                        <li>Managing Information assets</li>
                                        <li>ISO 15489</li>
                                        <li>ISO 5489 Part 1 and Part 2 overview</li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day4">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Document Management&Distribution:</b></p>
                                    <ul type="square">
                                        <li>Document Control</li>
                                        <li>Revisions/versions/histories</li>
                                        <li>Audit trails</li>
                                        <li>Reports</li>
                                        <li>Demonstration</li>
                                        <li>Forms Management</li>
                                        <li>Creating Forms</li>
                                        <li>Filling and saving forms/data</li>
                                        <li>Workflow Management</li>
                                        <li>Applications</li>
                                        <li>Creations</li>
                                        <li>Tracking/closure</li>
                                        <li>Demonstration</li>
                                        <li>Electronic Mail</li>
                                        <li>Concepts</li>
                                        <li>Demonstration</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day5">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Paper Records Processing System:</b></p>
                                    <ul type="square">
                                        <li>Explain the role of paper desk organization in records management</li>
                                        <li>Outline the options in the paper and email route</li>
                                        <li>Assess the efficiency of their departments' current information storage and filing system</li>
                                        <li>Describe classification, cross-references, and index systems for paper-basedstorage</li>
                                    </ul>
                                </div>

                                <div class="unit5">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>UNIT 5: Concepts and Set up Components:</b></p>
                                    <ul type="square">
                                        <li>Classification schemes</li>
                                        <li>Searching and retrieving</li>
                                        <li>Controls and security</li>
                                        <li>Metadata and indexing</li>
                                        <li>Document and records lifecycle</li>
                                        <li>Capture, store, and management</li>
                                        <li>Preserve and archive</li>
                                        <li>Presentation and delivery</li>
                                        <li>legislation, standards, and regulation</li>
                                        <li>Other Sources of Documents</li>
                                        <li>Word processors/spreadsheets</li>
                                        <li>Forms</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } elseif ($course_initial == "IFRS") { ?>
                            <div>
                                <!-- Day 1 -->
                                <div class="day1">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 1: Introduction to IFRS and presentation of financial statements</b></p>
                                    <ul type="square">
                                        <li>Defining the term 'IFRS'</li>
                                        <li>IFRS standard setting process</li>
                                        <li>Financial position presentation format as per IAS1, presentation of financial statements</li>
                                        <li>Components and classification of current and non-current assets and liabilities</li>
                                        <li>Offsetting assets and liabilities</li>
                                        <li>Income statement minimum presentation requirements as per IAS1, presentation of financial statements</li>
                                        <li>Presentation of revenues and expenses by nature or by function</li>
                                        <li>Components and classification of stockholders' equity</li>
                                        <li>Other comprehensive income: nature of its components</li>
                                        <li>Supplemental disclosures</li>
                                    </ul>
                                </div>

                                <!-- Day 2 -->
                                <div class="day2">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 2: Income Standards</b></p>
                                    <ul type="square">
                                        <li>IAS 18-Revenue</li>
                                        <li>IAS 11-Construction contracts</li>
                                    </ul>
                                </div>

                                <!-- Day 3 -->
                                <div class="day3">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 3: Asset standards</b></p>
                                    <ul type="square">
                                        <li><i>IAS 2-Inventories</i></li>
                                        <li><i>IAS 16-Property plant and equipment</i></li>
                                        <li><i>IAS 20-Government contracts</i></li>
                                        <li><i>IAS 23-Borrowing costs</i></li>
                                        <li><i>IAS 17-Leases</i></li>
                                        <li><i>IAS 38-Intangible assets</i></li>
                                        <li><i>IAS 40-Investment property</i></li>
                                        <li><i>IAS 41-Agriculture</i></li>
                                        <li><i>IAS 36-Impairment of assets</i></li>
                                        <li><i>IFRS 6- Exploration and evaluation</i></li>
                                    </ul>
                                </div>
                                <!-- Day 4 -->
                                <div class="day4">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 4: Liabilities standards</b></p>
                                    <ul type="square">
                                        <li>IAS 21-Effects in change in foreign exchange</li>
                                        <li>IAS 3 Business combinations</li>
                                        <li>IAS 11-Joint arrangement</li>
                                        <li>IAS 12-Disclosures</li>
                                        <li>IAS 13-Fair value measurement</li>
                                    </ul>
                                </div>
                                <!-- Day 5 -->
                                <div class="day5">
                                    <p><b><i class="bi bi-calendar-event-fill text-danger me-3"></i>DAY 5: Disclosures standards</b></p>
                                    <ul type="square">
                                        <li>IAS 33-Earning per share</li>
                                        <li>IFRS 8-Operating segments</li>
                                        <li>IFRS 5-Noncurrent assets held for sale & discontinued</li>
                                        <li>IAS 10-Events after the reporting period</li>
                                        <li>IAS 24-Related party disclosure</li>
                                        <li>IAS 34-Interim reporting</li>
                                        <li>IFRS-First time adoption of IFRS</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <form action="application.php" method="post">
                    <input type="hidden" name="course_id" value="<?= $course_id; ?>">
                    <input type="hidden" name="initial" value="<?= $rows['initial']; ?>">
                    <input type="hidden" name="training" value="<?= $rows['training']; ?>">
                    <input type="hidden" name="duration" value="<?= $rows['duration']; ?>">
                    <button type="submit" name="enrole" class="btn btn-primary col-6 my-5 fw-bolder fs-3">APPLY</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================End of hero div================== -->





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>