<?php
require_once __DIR__ . '/db.php';
$portalBootstrap = [
  'students' => portal_bootstrap_students(portal_connection()),
];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NUST Student Portal</title>
  <link rel="stylesheet" href="styles.css">
  <meta name="description" content="NUST student portal dashboard mockup">
  <script>
    window.__PORTAL_BOOTSTRAP__ = <?= json_encode($portalBootstrap, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
  </script>
</head>
<body>
  <section id="loginView" class="login-screen">
    <header class="login-banner">
      <img class="login-banner-logo" src="logo_nust_png.png" alt="NUST crest">
      <div class="login-banner-title">NATIONAL UNIVERSITY OF SCIENCE AND TECHNOLOGY</div>
    </header>

    <main class="hero">
      <div class="split left-panel">
        <img class="logo-blur" src="logo_nust_png.png" alt="NUST crest">
      </div>
      <div class="split right-panel"></div>

      <div class="login-card">
        <h2>PORTAL LOGIN</h2>
        <label class="login-role-label" for="loginRole">Login as</label>
        <select id="loginRole" class="login-role-select">
          <option value="student">Student</option>
          <option value="admin">Admin</option>
        </select>
        <form id="loginForm" onsubmit="handleSubmit(event)">
          <label class="sr-only" for="student">Student Number</label>
          <input id="student" name="student" placeholder="Student Number" autocomplete="username" />

          <label class="sr-only" for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Password" autocomplete="current-password" />

          <div class="login-actions">
            <button class="btn-primary" type="submit">LOG IN</button>
            <button class="btn-secondary signup-trigger" id="openSignupBtn" type="button">SIGN UP AS STUDENT</button>
          </div>
        </form>
        <p class="login-help">Demo admin credentials: admin / admin123</p>
      </div>
    </main>
  </section>

  <section id="dashboardView" class="dashboard-view is-hidden">
    <header class="topbar">
      <div class="topbar-left">
        <button id="menuToggle" class="icon-button" type="button" aria-label="Menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="topbar-title">NUST STUDENT PORTAL</div>
      </div>
      <div class="topbar-right">
        <button class="mail-button" type="button" aria-label="Messages">
          <span class="mail-symbol" aria-hidden="true"></span>
          <span class="badge">0</span>
        </button>
        <button class="logout-button" type="button" onclick="showLogin()">Logout</button>
      </div>
    </header>

    <div class="dashboard-shell">
      <aside class="sidebar">
        <div class="profile-card">
          <img src="logo_nust_png.png" alt="NUST crest" class="profile-logo" />
          <div class="profile-name">TAPIWA CHIGOME</div>
        </div>

        <nav class="side-nav" aria-label="Student navigation">
          <a class="side-link active" href="#dashboard">My Portal Dashboard</a>
          <a class="side-link" href="#registration">New Registration</a>
          <a class="side-link" href="#payments">Payments History</a>
          <a class="side-link" href="#results">Examinations Results</a>
          <a class="side-link" href="#assessment">Continuous Assessment</a>
          <a class="side-link" href="https://www.nust.ac.zw/" target="_blank" rel="noopener noreferrer">Exams Timetable</a>
          <a class="side-link" href="https://classroom.google.com/" target="_blank" rel="noopener noreferrer">NUST E-Learning</a>
          <a class="side-link" href="https://www.nust.ac.zw/" target="_blank" rel="noopener noreferrer">Main Website</a>
        </nav>
      </aside>

      <main class="dashboard" id="dashboard">
        <div id="dashboardHome">
        <section class="quick-actions">
          <article class="action-card green">
            <div class="action-icon icon-quote" aria-hidden="true"></div>
            <h2>GET FEES QUOTE</h2>
            <p>Get your fees invoice.</p>
          </article>
          <article class="action-card blue" data-action="ecocash">
            <div class="action-icon icon-pay" aria-hidden="true"></div>
            <h2>PAY TUITION FEES</h2>
            <p>Pay instantly with Ecocash.</p>
          </article>
          <article class="action-card red" data-action="bank">
            <div class="action-icon icon-online" aria-hidden="true"></div>
            <h2>PAY ONLINE</h2>
            <p>Secure Payments With FBC</p>
          </article>
          <article class="action-card orange" data-action="enquiry">
            <div class="action-icon icon-enquiry" aria-hidden="true"></div>
            <h2>ENQUIRIES</h2>
            <p>We are here to serve you</p>
          </article>
          <article class="action-card teal" data-action="calendar">
            <div class="action-icon icon-calendar" aria-hidden="true"></div>
            <h2>NUST CALENDAR APP</h2>
            <p>Download Android APK</p>
          </article>
        </section>

        <section class="notice-banner">
          <strong>ARE YOU A REGISTERED STUDENT?</strong> TO START THE REGISTRATION PROCESS PLEASE CLICK HERE.
        </section>

        <section id="registration" class="panel registration-panel is-hidden">
          <div class="panel-header">NEW REGISTRATION</div>
          <div class="registration-body">
            <div id="registrationNotice" class="registration-notice"></div>
            <form id="registrationForm" class="registration-form">
              <div class="registration-summary">
                <div>
                  <span>Student Number</span>
                  <strong id="registrationStudentNumber">-</strong>
                </div>
                <div>
                  <span>Fees Paid</span>
                  <strong id="registrationFeesPaid">USD 0.00</strong>
                </div>
                <div>
                  <span>Required to Register</span>
                  <strong>50% of USD 745</strong>
                </div>
              </div>

              <div class="registration-fields">
                <label>
                  <span>Academic Year</span>
                  <input id="registrationAcademicYear" type="text" placeholder="2026" required />
                </label>
                <label>
                  <span>Part</span>
                  <select id="registrationPart" required>
                    <option value="1">Part 1</option>
                    <option value="2">Part 2</option>
                    <option value="3">Part 3</option>
                    <option value="4">Part 4</option>
                    <option value="5">Part 5</option>
                  </select>
                </label>
                <label>
                  <span>Semester</span>
                  <select id="registrationSemester" required>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                  </select>
                </label>
              </div>

              <div>
                <div class="registration-subtitle">Select courses for this semester</div>
                <div id="registrationCourseList" class="registration-course-list"></div>
              </div>

              <div class="registration-actions">
                <button class="btn-primary" type="submit" id="registrationSubmitBtn">Register Semester</button>
              </div>
            </form>
          </div>
        </section>

        <section class="content-grid">
          <article class="panel personal-panel">
            <div class="panel-header">PERSONAL DETAILS</div>
            <div class="personal-body">
              <img src="logo_nust_png.png" alt="Student crest" class="detail-logo" />
              <div class="personal-copy" id="studentPersonalCopy"></div>
            </div>
          </article>

          <article class="panel courses-panel">
            <div class="panel-header">CURRENTLY REGISTERED COURSES</div>
            <table class="course-table">
              <thead>
                <tr>
                  <th>Course Code</th>
                  <th>Course Name</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody id="studentCoursesBody"></tbody>
            </table>
            <div class="info-callout success" id="coursesCallout">It is the responsibility of the student to make sure that the courses above are correct.</div>
          </article>

          <article class="panel academic-panel">
            <div class="panel-header">ACADEMIC DETAILS</div>
            <table class="detail-table">
              <tbody id="studentAcademicRows"></tbody>
            </table>
          </article>

          <article class="panel financial-panel">
            <div class="panel-header">FINANCIAL DETAILS</div>
            <table class="detail-table">
              <tbody id="studentFinancialRows"></tbody>
            </table>
            <div class="info-callout danger" id="studentFinancialCallout">Students are advised to clear their fees before the start of exams.</div>
          </article>
        </section>

        <section class="utility-strip">
          <a class="utility-card" href="https://mail.google.com/" target="_blank" rel="noopener noreferrer"><span class="utility-icon utility-icon-webmail" aria-hidden="true"></span><span>Students Webmail</span></a>
          <a class="utility-card" href="https://classroom.google.com/" target="_blank" rel="noopener noreferrer"><span class="utility-icon utility-icon-classroom" aria-hidden="true"></span><span>Google Classroom</span></a>
          <a class="utility-card" href="https://www.nust.ac.zw/" target="_blank" rel="noopener noreferrer"><span class="utility-icon utility-icon-resources" aria-hidden="true"></span><span>E-Resources</span></a>
        </section>

        <section class="info-grid">
          <article class="mini-panel">
            <div class="mini-header dark">Point Of Sale Service</div>
            <p>NUST is now accepting fees payments by swiping via the Point of Sale platform at the Bursar Banking Hall and Harare Office. Bank cards that are accepted are all local ZimSwitch cards, all MasterCards and Visa cards. Students can also pay online via Ecocash, Telecash, Visa or Mastercard.</p>
          </article>

          <article class="mini-panel">
            <div class="mini-header pink">Reminder On Registration</div>
            <p>Please note that students who are not registered will not be allowed to access University facilities. Therefore, students are urged to regularise their registration status to avoid inconveniences.</p>
          </article>

          <article class="mini-panel">
            <div class="mini-header green">How To Register</div>
            <ol>
              <li>Open the NUST website http://www.nust.ac.zw</li>
              <li>Click on Student Portal</li>
              <li>Enter your login credentials</li>
              <li>After logging on, click on New Registration</li>
              <li>Verify the Semester and Courses and click submit</li>
            </ol>
          </article>

          <article class="mini-panel">
            <div class="mini-header blue">USSD Payment</div>
            <p>Good News! For your added convenience, you can now pay your NUST fees using USSD code, *151*2*3*9*2#</p>
          </article>
        </section>

        </div>

        <section id="payments" class="panel payments-panel is-hidden">
          <div class="panel-header">Payment History</div>
          <div class="payments-body">
            <div class="account-banner">ACCOUNT INFORMATION:</div>
            <div class="balance-line" id="paymentsBalanceLine">Overall Balance: <strong>USD 349.73</strong></div>

            <div class="ledger-section">
              <h4>ZIG ENTRIES</h4>
              <table class="payments-table enhance-table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Currency Code</th>
                    <th>Amount</th>
                    <th>USD Equivalent</th>
                  </tr>
                </thead>
                <tbody id="zigPaymentsBody"></tbody>
              </table>
            </div>

            <div class="ledger-section">
              <h4>USD ENTRIES</h4>
              <table class="payments-table enhance-table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Currency Code</th>
                    <th>Amount</th>
                    <th>USD Equivalent</th>
                  </tr>
                </thead>
                <tbody id="usdPaymentsBody"></tbody>
              </table>
            </div>

            <div class="historic-callout">HAVE HISTORICAL PAYMENTS? <a href="#">CLICK HERE TO VIEW.</a></div>

            <div class="export-wrap">
              <button class="export-btn" data-target="#payments">Export as PDF</button>
            </div>
          </div>
        </section>

        <section id="results" class="panel results-panel is-hidden">
          <div class="panel-header">Examination Results</div>
          <div class="results-profile panel">
            <div class="results-profile-body" id="resultsProfileBody"></div>
          </div>
          <div class="results-body">
            <div class="results-title">Examination Results</div>
            <p class="results-sub">Please Ignore Duplicate Results.</p>

            <div class="note-box">NOTE: One (1) credit denotes approximately ten (10) notional study hours of the average student's academic workload (spent in class, out-of-class, and in taking appropriate examinations)</div>

            <div id="resultsAccessNotice" class="results-access-note"></div>

            <div class="results-table-wrap">
              <table class="results-table enhance-table">
                <thead>
                  <tr>
                    <th>Academic Year</th>
                    <th>Part</th>
                    <th>Semester</th>
                    <th>Entry Type</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Mark</th>
                    <th>Classification</th>
                    <th>Earned Credits</th>
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody id="studentResultsBody"></tbody>
              </table>
            </div>

            <div class="export-wrap"><button class="export-btn" data-target="#results">Export as PDF</button></div>
          </div>
        </section>

        <section id="assessment" class="panel assessment-panel is-hidden">
          <div class="panel-header">Continuous Assessment</div>
          <div class="assessment-profile panel">
            <div class="assessment-profile-body" id="assessmentProfileBody"></div>
          </div>

          <div class="assessment-body">
            <div class="assessment-table-wrap">
              <table class="assessment-table enhance-table">
                <thead>
                  <tr>
                    <th>Academic Year</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Mark</th>
                  </tr>
                </thead>
                <tbody id="studentAssessmentBody"></tbody>
              </table>
            </div>

            <div class="export-wrap"><button class="export-btn" data-target="#assessment">Export as PDF</button></div>
          </div>
        </section>

        <footer class="footer-bar">© 2026 GROUP PROJECT: "Think In Other Terms"</footer>
      </main>
    </div>
  </section>

  <section id="adminView" class="dashboard-view is-hidden">
    <header class="topbar">
      <div class="topbar-left">
        <div class="topbar-title">NUST ADMIN PORTAL</div>
      </div>
      <div class="topbar-right">
        <button class="logout-button" type="button" onclick="showLogin()">Logout</button>
      </div>
    </header>

    <div class="dashboard-shell admin-shell">
      <aside class="sidebar">
        <div class="profile-card">
          <img src="logo_nust_png.png" alt="NUST crest" class="profile-logo" />
          <div class="profile-name">SYSTEM ADMIN</div>
        </div>

        <nav class="side-nav" aria-label="Admin navigation">
          <a class="side-link active" href="#admin-overview">Overview</a>
          <a class="side-link" href="#admin-students">Students</a>
          <a class="side-link" href="#admin-fees">Fees</a>
          <a class="side-link" href="#admin-assessment">Continuous Assessment</a>
          <a class="side-link" href="#admin-results">Examination Results</a>
          <a class="side-link" href="#admin-signups">Signups</a>
        </nav>
      </aside>

      <main class="dashboard admin-dashboard" id="adminDashboard">
        <section id="admin-overview" class="panel admin-summary-panel">
          <div class="panel-header">ADMIN OVERVIEW</div>
          <div class="admin-summary-grid">
            <article class="admin-stat-card">
              <span>Total Students</span>
              <strong id="adminStudentCount">0</strong>
            </article>
            <article class="admin-stat-card">
              <span>Fees Cleared</span>
              <strong id="adminClearedCount">0</strong>
            </article>
            <article class="admin-stat-card">
              <span>Pending Fees</span>
              <strong id="adminPendingCount">0</strong>
            </article>
          </div>
        </section>

        <section class="admin-grid">
          <article id="admin-fees" class="panel admin-form-panel">
            <div class="panel-header">UPDATE FEES PAYMENT</div>
            <form id="feesForm" class="admin-form">
              <label>
                <span>Student</span>
                <select id="feesStudentSelect"></select>
              </label>
              <label>
                <span>Currency</span>
                <select id="feesCurrency">
                  <option value="USD">USD</option>
                  <option value="ZIG">ZIG</option>
                </select>
              </label>
              <label>
                <span>Amount Paid</span>
                <input id="feesAmount" type="number" min="0.01" step="0.01" placeholder="150.00" required />
              </label>
              <label>
                <span>Reference</span>
                <input id="feesReference" type="text" placeholder="Receipt number or note" />
              </label>
              <button class="btn-primary" type="submit">Save Payment</button>
            </form>
          </article>

          <article id="admin-assessment" class="panel admin-form-panel">
            <div class="panel-header">UPLOAD CONTINUOUS ASSESSMENT</div>
            <form id="assessmentForm" class="admin-form">
              <label><span>Student</span><select id="assessmentStudentSelect"></select></label>
              <label><span>Academic Year</span><input id="assessmentYear" type="text" placeholder="2026" required /></label>
              <label><span>Course Code</span><input id="assessmentCourseCode" type="text" placeholder="SCS2104" required /></label>
              <label><span>Course Name</span><input id="assessmentCourseName" type="text" placeholder="Structured Systems Analysis" required /></label>
              <label><span>Description</span><input id="assessmentDescription" type="text" placeholder="Overall Assessment" required /></label>
              <label><span>Type</span><input id="assessmentType" type="text" placeholder="Contributing" required /></label>
              <label><span>Mark</span><input id="assessmentMark" type="number" min="0" max="100" step="0.01" placeholder="72" required /></label>
              <button class="btn-primary" type="submit">Upload Assessment</button>
            </form>
          </article>

          <article id="admin-results" class="panel admin-form-panel">
            <div class="panel-header">UPLOAD EXAMINATION RESULTS</div>
            <form id="resultsForm" class="admin-form">
              <label><span>Student</span><select id="resultsStudentSelect"></select></label>
              <label><span>Academic Year</span><input id="resultsYear" type="text" placeholder="2026" required /></label>
              <label><span>Part</span><input id="resultsPart" type="text" placeholder="2" required /></label>
              <label><span>Semester</span><input id="resultsSemester" type="text" placeholder="1" required /></label>
              <label><span>Entry Type</span><input id="resultsEntryType" type="text" placeholder="COURSE" required /></label>
              <label><span>Course Code</span><input id="resultsCourseCode" type="text" placeholder="SCS2114" required /></label>
              <label><span>Course Name</span><input id="resultsCourseName" type="text" placeholder="Web Development" required /></label>
              <label><span>Mark</span><input id="resultsMark" type="number" min="0" max="100" step="0.01" placeholder="89" required /></label>
              <label><span>Classification</span><input id="resultsClassification" type="text" placeholder="1" required /></label>
              <label><span>Earned Credits</span><input id="resultsCredits" type="number" min="0" step="1" placeholder="10" required /></label>
              <label><span>Remark</span><input id="resultsRemark" type="text" placeholder="Pass" required /></label>
              <button class="btn-primary" type="submit">Upload Result</button>
            </form>
          </article>
        </section>

        <section id="admin-students" class="panel admin-table-panel">
          <div class="panel-header">STUDENT RECORDS</div>
          <div class="table-wrap admin-table-wrap">
            <table class="results-table enhance-table" id="adminStudentsTable">
              <thead>
                <tr>
                  <th>Student Number</th>
                  <th>Name</th>
                  <th>Programme</th>
                  <th>Fees Paid</th>
                  <th>Balance</th>
                  <th>Registration</th>
                  <th>Results</th>
                </tr>
              </thead>
              <tbody id="adminStudentsBody"></tbody>
            </table>
          </div>
        </section>

        <section id="admin-signups" class="panel admin-table-panel">
          <div class="panel-header">NEW SIGNUPS</div>
          <div id="adminSignupFeed" class="admin-feed"></div>
        </section>
      </main>
    </div>
  </section>

  <div id="actionModal" class="modal-backdrop is-hidden" aria-hidden="true">
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <button id="closeModalBtn" class="modal-close" type="button" aria-label="Close">×</button>
      <h3 id="modalTitle">Payment & Enquiry</h3>
      <p id="modalIntro" class="modal-intro"></p>
      <form id="actionForm" class="modal-form" novalidate>
        <div id="modalFields"></div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" id="cancelModalBtn">Cancel</button>
          <button class="btn-primary" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <div id="signupModal" class="modal-backdrop is-hidden" aria-hidden="true">
    <div class="modal-card signup-card" role="dialog" aria-modal="true" aria-labelledby="signupTitle">
      <button id="closeSignupBtn" class="modal-close" type="button" aria-label="Close">×</button>
      <h3 id="signupTitle">Create Student Account</h3>
      <p class="modal-intro">Create a student profile and save your login details for future access.</p>
      <form id="signupForm" class="modal-form" novalidate>
        <label class="modal-field"><span>Full Name</span><input name="fullName" type="text" placeholder="Tapiwa Chigome" required></label>
        <label class="modal-field"><span>Student Number</span><input name="studentNumber" type="text" placeholder="N02530153A" required></label>
        <label class="modal-field"><span>National ID#</span><input name="nationalId" type="text" placeholder="63-2600955H58" required></label>
        <label class="modal-field"><span>Date Of Birth</span><input name="dateOfBirth" type="date" required></label>
        <label class="modal-field"><span>Place Of Birth</span><input name="placeOfBirth" type="text" placeholder="Kwekwe" required></label>
        <label class="modal-field"><span>Email</span><input name="email" type="email" placeholder="student@nust.ac.zw" required></label>
        <label class="modal-field"><span>Password</span><input name="password" type="password" placeholder="Create a password" required></label>
        <label class="modal-field"><span>Phone Number</span><input name="phone" type="text" placeholder="263772739852" required></label>
        <label class="modal-field"><span>Programme</span><input name="programme" type="text" placeholder="Computer Science" required></label>
        <label class="modal-field"><span>Gender</span><input name="gender" type="text" placeholder="Female" required></label>
        <label class="modal-field"><span>Address</span><input name="address" type="text" placeholder="Victoria Range, Masvingo, Zimbabwe" required></label>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" id="cancelSignupBtn">Cancel</button>
          <button class="btn-primary" type="submit">Create Account</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    (function loadJsPDF() {
      const script = document.createElement('script');
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
      script.defer = true;
      document.head.appendChild(script);
    })();

    const TOTAL_FEES = 745;
    const REGISTRATION_THRESHOLD = TOTAL_FEES / 2;
    const PORTAL_API = 'api.php';

    const loginView = document.getElementById('loginView');
    const dashboardView = document.getElementById('dashboardView');
    const adminView = document.getElementById('adminView');
    const loginRole = document.getElementById('loginRole');
    const studentInput = document.getElementById('student');
    const passwordInput = document.getElementById('password');
    const loginForm = document.getElementById('loginForm');
    const openSignupBtn = document.getElementById('openSignupBtn');
    const signupModal = document.getElementById('signupModal');
    const signupForm = document.getElementById('signupForm');
    const closeSignupBtn = document.getElementById('closeSignupBtn');
    const cancelSignupBtn = document.getElementById('cancelSignupBtn');

    const dashboardHome = document.getElementById('dashboardHome');
    const registrationSection = document.getElementById('registration');
    const paymentsSection = document.getElementById('payments');
    const resultsSection = document.getElementById('results');
    const assessmentSection = document.getElementById('assessment');
    const menuToggle = document.getElementById('menuToggle');
    const actionModal = document.getElementById('actionModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalIntro = document.getElementById('modalIntro');
    const modalFields = document.getElementById('modalFields');
    const actionForm = document.getElementById('actionForm');

    const studentProfileName = dashboardView.querySelector('.profile-name');
    const studentPersonalCopy = document.getElementById('studentPersonalCopy');
    const studentCoursesBody = document.getElementById('studentCoursesBody');
    const studentAcademicRows = document.getElementById('studentAcademicRows');
    const studentFinancialRows = document.getElementById('studentFinancialRows');
    const studentFinancialCallout = document.getElementById('studentFinancialCallout');
    const registrationNotice = document.getElementById('registrationNotice');
    const registrationForm = document.getElementById('registrationForm');
    const registrationStudentNumber = document.getElementById('registrationStudentNumber');
    const registrationFeesPaid = document.getElementById('registrationFeesPaid');
    const registrationAcademicYear = document.getElementById('registrationAcademicYear');
    const registrationPart = document.getElementById('registrationPart');
    const registrationSemester = document.getElementById('registrationSemester');
    const registrationCourseList = document.getElementById('registrationCourseList');
    const registrationSubmitBtn = document.getElementById('registrationSubmitBtn');
    const paymentsBalanceLine = document.getElementById('paymentsBalanceLine');
    const zigPaymentsBody = document.getElementById('zigPaymentsBody');
    const usdPaymentsBody = document.getElementById('usdPaymentsBody');
    const resultsProfileBody = document.getElementById('resultsProfileBody');
    const resultsAccessNotice = document.getElementById('resultsAccessNotice');
    const studentResultsBody = document.getElementById('studentResultsBody');
    const assessmentProfileBody = document.getElementById('assessmentProfileBody');
    const studentAssessmentBody = document.getElementById('studentAssessmentBody');

    const adminStudentCount = document.getElementById('adminStudentCount');
    const adminClearedCount = document.getElementById('adminClearedCount');
    const adminPendingCount = document.getElementById('adminPendingCount');
    const feesStudentSelect = document.getElementById('feesStudentSelect');
    const feesCurrency = document.getElementById('feesCurrency');
    const feesAmount = document.getElementById('feesAmount');
    const feesReference = document.getElementById('feesReference');
    const assessmentStudentSelect = document.getElementById('assessmentStudentSelect');
    const assessmentYear = document.getElementById('assessmentYear');
    const assessmentCourseCode = document.getElementById('assessmentCourseCode');
    const assessmentCourseName = document.getElementById('assessmentCourseName');
    const assessmentDescription = document.getElementById('assessmentDescription');
    const assessmentType = document.getElementById('assessmentType');
    const assessmentMark = document.getElementById('assessmentMark');
    const resultsStudentSelect = document.getElementById('resultsStudentSelect');
    const resultsYear = document.getElementById('resultsYear');
    const resultsPart = document.getElementById('resultsPart');
    const resultsSemester = document.getElementById('resultsSemester');
    const resultsEntryType = document.getElementById('resultsEntryType');
    const resultsCourseCode = document.getElementById('resultsCourseCode');
    const resultsCourseName = document.getElementById('resultsCourseName');
    const resultsMark = document.getElementById('resultsMark');
    const resultsClassification = document.getElementById('resultsClassification');
    const resultsCredits = document.getElementById('resultsCredits');
    const resultsRemark = document.getElementById('resultsRemark');
    const adminStudentsBody = document.getElementById('adminStudentsBody');
    const adminSignupFeed = document.getElementById('adminSignupFeed');
    const feesForm = document.getElementById('feesForm');
    const assessmentForm = document.getElementById('assessmentForm');
    const resultsForm = document.getElementById('resultsForm');
    let studentsCache = [];

    const actionConfigs = {
      ecocash: {
        title: 'Pay Tuition Fees with EcoCash',
        intro: 'Enter your Econet mobile number and amount. We validate the number format before submission.',
        fields: [
          { name: 'phone', label: 'Econet Number', type: 'text', placeholder: '+263781234567', required: true },
          { name: 'amount', label: 'Amount (USD)', type: 'number', min: '1', step: '0.01', placeholder: '250', required: true }
        ],
        submit: (values) => {
          const phone = values.phone.trim();
          const amount = values.amount.trim();
          const phonePattern = /^\+263(78\d{7}|772\d{6})$/;
          if (!phonePattern.test(phone)) {
            return { ok: false, message: 'Please enter a valid Econet number starting with +26378 or +263772.' };
          }
          if (!amount || Number(amount) <= 0) {
            return { ok: false, message: 'Enter a valid amount greater than zero.' };
          }
          return { ok: true, message: `EcoCash payment request sent for ${phone} for USD ${Number(amount).toFixed(2)}. Please complete the prompt on your phone.` };
        }
      },
      bank: {
        title: 'Pay Online with Bank Details',
        intro: 'Enter your bank details to continue with your secure online payment.',
        fields: [
          { name: 'bankName', label: 'Bank Name', type: 'text', placeholder: 'FBC Bank', required: true },
          { name: 'accountNumber', label: 'Bank Account Number', type: 'text', placeholder: '1234567890', required: true },
          { name: 'branch', label: 'Branch', type: 'text', placeholder: 'Harare', required: true },
          { name: 'amount', label: 'Amount (USD)', type: 'number', min: '1', step: '0.01', placeholder: '500', required: true }
        ],
        submit: (values) => {
          const accountNumber = values.accountNumber.trim();
          const amount = values.amount.trim();
          if (!/^\d{6,}$/.test(accountNumber)) {
            return { ok: false, message: 'Bank account number must contain at least 6 digits.' };
          }
          if (!amount || Number(amount) <= 0) {
            return { ok: false, message: 'Enter a valid amount greater than zero.' };
          }
          return { ok: true, message: `Bank payment request created for ${values.bankName.trim()} account ${accountNumber}. Please confirm the amount of USD ${Number(amount).toFixed(2)}.` };
        }
      },
      enquiry: {
        title: 'Send an Enquiry',
        intro: 'Share your student details and message. We will review your enquiry and reply to your university email.',
        fields: [
          { name: 'studentNumber', label: 'Student Number', type: 'text', placeholder: 'N02530153A', required: true },
          { name: 'studentEmail', label: 'Student Email', type: 'email', placeholder: 'student@nust.ac.zw', required: true },
          { name: 'message', label: 'Message', type: 'textarea', placeholder: 'Write your query here...', required: true }
        ],
        submit: (values) => {
          const studentNumber = values.studentNumber.trim().toUpperCase();
          const studentEmail = values.studentEmail.trim();
          const message = values.message.trim();
          const studentPattern = /^N\d{8}[A-Z]$/;
          const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!studentPattern.test(studentNumber)) {
            return { ok: false, message: 'Student number must look like N02530153A.' };
          }
          if (!emailPattern.test(studentEmail)) {
            return { ok: false, message: 'Enter a valid university email address.' };
          }
          if (message.length < 10) {
            return { ok: false, message: 'Please write at least 10 characters in your message.' };
          }
          return { ok: true, message: `Enquiry received from ${studentNumber} (${studentEmail}). Your message has been sent to the university support team.` };
        }
      },
      calendar: {
        title: 'NUST Calendar App',
        intro: 'Use the link below to download the NUST Calendar App.',
        fields: [],
        submit: () => ({ ok: true, message: 'Download link ready.' })
      }
    };

    const registrationCourseCatalog = {
      '1-1': [
        { courseCode: 'SCS1101', courseName: 'Introduction to Computer Programming', type: 'CORE' },
        { courseCode: 'SCS1102', courseName: 'Computer Mathematics I', type: 'CORE' },
        { courseCode: 'SCS1103', courseName: 'Computer Literacy and Productivity', type: 'CORE' },
        { courseCode: 'SCS1104', courseName: 'Introduction to Information Systems', type: 'CORE' },
        { courseCode: 'SCS1105', courseName: 'Communication Skills for Computing', type: 'CORE' },
        { courseCode: 'SCS1106', courseName: 'Digital Logic Fundamentals', type: 'CORE' }
      ],
      '1-2': [
        { courseCode: 'SCS1201', courseName: 'Object Oriented Programming I', type: 'CORE' },
        { courseCode: 'SCS1202', courseName: 'Discrete Mathematics', type: 'CORE' },
        { courseCode: 'SCS1203', courseName: 'Web Design Fundamentals', type: 'CORE' },
        { courseCode: 'SCS1204', courseName: 'Database Fundamentals', type: 'CORE' },
        { courseCode: 'SCS1205', courseName: 'Systems Analysis Basics', type: 'CORE' },
        { courseCode: 'SCS1206', courseName: 'Computer Networking Basics', type: 'CORE' }
      ],
      '2-1': [
        { courseCode: 'SCS2101', courseName: 'Data Structures', type: 'CORE' },
        { courseCode: 'SCS2102', courseName: 'Algorithms and Complexity', type: 'CORE' },
        { courseCode: 'SCS2103', courseName: 'Operating Systems Concepts', type: 'CORE' },
        { courseCode: 'SCS2104', courseName: 'Software Engineering Principles', type: 'CORE' },
        { courseCode: 'SCS2105', courseName: 'Probability and Statistics', type: 'CORE' },
        { courseCode: 'SCS2106', courseName: 'Computer Architecture', type: 'CORE' }
      ],
      '2-2': [
        { courseCode: 'SCS2201', courseName: 'Advanced Programming Concepts', type: 'CORE' },
        { courseCode: 'SCS2202', courseName: 'Systems Analysis and Design II', type: 'CORE' },
        { courseCode: 'SCS2203', courseName: 'Software Project Management', type: 'CORE' },
        { courseCode: 'SCS2204', courseName: 'Human Computer Interaction', type: 'CORE' },
        { courseCode: 'SCS2205', courseName: 'Internet Programming', type: 'CORE' },
        { courseCode: 'SCS2206', courseName: 'Computer Networks II', type: 'CORE' }
      ],
      '3-1': [
        { courseCode: 'SCS3101', courseName: 'Advanced Java Programming', type: 'CORE' },
        { courseCode: 'SCS3102', courseName: 'Software Testing and Quality Assurance', type: 'CORE' },
        { courseCode: 'SCS3103', courseName: 'Mobile Application Development', type: 'CORE' },
        { courseCode: 'SCS3104', courseName: 'Distributed Systems', type: 'CORE' },
        { courseCode: 'SCS3105', courseName: 'Artificial Intelligence Fundamentals', type: 'CORE' },
        { courseCode: 'SCS3106', courseName: 'Research Methods I', type: 'CORE' }
      ],
      '3-2': [
        { courseCode: 'SCS3201', courseName: 'Cloud Computing', type: 'CORE' },
        { courseCode: 'SCS3202', courseName: 'Cyber Security Principles', type: 'CORE' },
        { courseCode: 'SCS3203', courseName: 'Compiler Construction', type: 'CORE' },
        { courseCode: 'SCS3204', courseName: 'Human Computer Interaction II', type: 'CORE' },
        { courseCode: 'SCS3205', courseName: 'Data Mining and Warehousing', type: 'CORE' },
        { courseCode: 'SCS3206', courseName: 'Project Development I', type: 'CORE' }
      ],
      '4-1': [
        { courseCode: 'SCS4101', courseName: 'Enterprise Systems', type: 'CORE' },
        { courseCode: 'SCS4102', courseName: 'DevOps and CI/CD', type: 'CORE' },
        { courseCode: 'SCS4103', courseName: 'Machine Learning Applications', type: 'CORE' },
        { courseCode: 'SCS4104', courseName: 'Information Security Management', type: 'CORE' },
        { courseCode: 'SCS4105', courseName: 'Advanced Computer Networks', type: 'CORE' },
        { courseCode: 'SCS4106', courseName: 'Research Methods II', type: 'CORE' }
      ],
      '4-2': [
        { courseCode: 'SCS4201', courseName: 'Big Data Analytics', type: 'CORE' },
        { courseCode: 'SCS4202', courseName: 'Distributed Database Systems', type: 'CORE' },
        { courseCode: 'SCS4203', courseName: 'UX Design and Evaluation', type: 'CORE' },
        { courseCode: 'SCS4204', courseName: 'Blockchain Technologies', type: 'CORE' },
        { courseCode: 'SCS4205', courseName: 'Project Development II', type: 'CORE' },
        { courseCode: 'SCS4206', courseName: 'Industrial Attachment Preparation', type: 'CORE' }
      ],
      '5-1': [
        { courseCode: 'SCS5101', courseName: 'Software Architecture', type: 'CORE' },
        { courseCode: 'SCS5102', courseName: 'Advanced Artificial Intelligence', type: 'CORE' },
        { courseCode: 'SCS5103', courseName: 'Professional Practice and Ethics', type: 'CORE' },
        { courseCode: 'SCS5104', courseName: 'Entrepreneurship for Technologists', type: 'CORE' },
        { courseCode: 'SCS5105', courseName: 'Innovation and Product Design', type: 'CORE' },
        { courseCode: 'SCS5106', courseName: 'Research Proposal Development', type: 'CORE' }
      ],
      '5-2': [
        { courseCode: 'SCS5201', courseName: 'Capstone Project', type: 'CORE' },
        { courseCode: 'SCS5202', courseName: 'Emerging Technologies', type: 'CORE' },
        { courseCode: 'SCS5203', courseName: 'Advanced Quality Assurance', type: 'CORE' },
        { courseCode: 'SCS5204', courseName: 'Innovation Management', type: 'CORE' },
        { courseCode: 'SCS5205', courseName: 'Research Seminar', type: 'CORE' },
        { courseCode: 'SCS5206', courseName: 'Thesis Presentation', type: 'CORE' }
      ]
    };

    function getRegistrationCatalog(part, semester) {
      const key = `${String(part || '1').trim()}-${String(semester || '1').trim()}`;
      return registrationCourseCatalog[key] || registrationCourseCatalog['1-1'];
    }

    function renderRegistrationCourseOptions(student, preserveSelection = false) {
      if (!registrationSection || !registrationForm || !registrationCourseList) return;

      const status = getStudentStatus(student);
      if (!preserveSelection) {
        registrationPart.value = student?.currentPart || '1';
        registrationSemester.value = student?.currentSemester === '1' ? '2' : '1';
      }

      const selectedPart = registrationPart?.value || student?.currentPart || '1';
      const selectedSemester = registrationSemester?.value || student?.currentSemester || '1';
      const selectedCatalog = getRegistrationCatalog(selectedPart, selectedSemester);

      registrationStudentNumber.textContent = student?.studentNumber || '-';
      registrationFeesPaid.textContent = `USD ${formatMoney(status.feesPaid)}`;

      if (status.canRegister) {
        registrationNotice.innerHTML = `<strong>Registration open.</strong> Part ${escapeHtml(selectedPart)} Semester ${escapeHtml(selectedSemester)} is ready. Select the courses you want to take.`;
        registrationCourseList.innerHTML = selectedCatalog.map(course => `
          <label class="registration-course-option">
            <input type="checkbox" name="courses" value="${escapeHtml(course.courseCode)}" checked />
            <span>
              <strong>${escapeHtml(course.courseCode)}</strong>
              <small>${escapeHtml(course.courseName)}</small>
            </span>
          </label>
        `).join('');
        registrationForm.querySelectorAll('input, select, button').forEach(control => {
          control.disabled = false;
        });
        registrationSubmitBtn.textContent = 'Register Semester';
      } else {
        registrationNotice.innerHTML = `<strong>Registration locked.</strong> You need at least USD ${formatMoney(REGISTRATION_THRESHOLD)} paid before registering a new semester.`;
        registrationCourseList.innerHTML = '<div class="registration-locked">Course registration will appear after the 50% payment threshold is reached.</div>';
        registrationForm.querySelectorAll('input, select, button').forEach(control => {
          control.disabled = true;
        });
      }
    }

    const defaultStudent = {
      studentNumber: 'N02529721P',
      password: 'nust1234',
      fullName: 'Tapiwa Chigome',
      surname: 'Chigome',
      givenNames: 'Tapiwa',
      gender: 'Female',
      nationalId: '63-2600955H58',
      dateOfBirth: '2006-01-09',
      placeOfBirth: 'Kwekwe',
      programme: 'Bachelor of Science Honours Degree in Computer Science',
      programmeCode: 'SCS',
      email: 'tapiwa.chigome@nust.ac.zw',
      phone: '263772739852',
      addressLines: ['Victoria Range', 'Masvingo', 'Zimbabwe'],
      currentAcademicYear: '2026',
      currentPart: '2',
      currentSemester: '1',
      transcriptCleared: 'No',
      feesPaid: 395.27,
      paymentPlan: 'You are not on Payment Plan!',
      libraryFines: '',
      itemsOwed: '',
      courses: [
        { courseCode: 'SCS2104', courseName: 'Structured Systems Analysis and Design', type: 'CORE' },
        { courseCode: 'SCS2108', courseName: 'Object Oriented Software Concepts and Development', type: 'CORE' },
        { courseCode: 'SCS2110', courseName: 'Research Methods', type: 'CORE' },
        { courseCode: 'SCS2111', courseName: 'Data Communications and Computer Networks', type: 'CORE' },
        { courseCode: 'SCS2114', courseName: 'Web Development', type: 'CORE' },
        { courseCode: 'SCS2110', courseName: 'Introduction to Applied Statistics', type: 'CORE' }
      ],
      continuousAssessment: [
        { academicYear: '2025', courseCode: 'SCS1101', courseName: 'Introduction to Computer Science and Programming', description: 'Overall Assessment', type: 'Contributing', mark: '72.00' },
        { academicYear: '2025', courseCode: 'SCS1101', courseName: 'Introduction to Computer Science and Programming', description: 'Overall', type: 'Aggregating', mark: '72.00' },
        { academicYear: '2025', courseCode: 'SCS1103', courseName: 'Operating Systems Concepts', description: 'Overall Assessment', type: 'Contributing', mark: '75.00' },
        { academicYear: '2025', courseCode: 'SCS1103', courseName: 'Operating Systems Concepts', description: 'Overall', type: 'Aggregating', mark: '75.00' },
        { academicYear: '2025', courseCode: 'SCS1111', courseName: 'Principles of Programming Languages', description: 'Overall Assessment', type: 'Contributing', mark: '92.00' },
        { academicYear: '2025', courseCode: 'SCS1111', courseName: 'Principles of Programming Languages', description: 'Overall', type: 'Aggregating', mark: '92.00' },
        { academicYear: '2025', courseCode: 'SCS1112', courseName: 'Fundamentals of Digital Electronics', description: 'Overall Assessment', type: 'Contributing', mark: '79.00' },
        { academicYear: '2025', courseCode: 'SCS1112', courseName: 'Fundamentals of Digital Electronics', description: 'Overall', type: 'Aggregating', mark: '79.00' },
        { academicYear: '2025', courseCode: 'SCS1210', courseName: 'Discrete Mathematics', description: 'Overall Assessment', type: 'Contributing', mark: '83.00' },
        { academicYear: '2025', courseCode: 'SCS1210', courseName: 'Discrete Mathematics', description: 'Overall', type: 'Aggregating', mark: '83.00' },
        { academicYear: '2025', courseCode: 'SCS1213', courseName: 'Database Systems', description: 'Overall Assessment', type: 'Contributing', mark: '86.00' },
        { academicYear: '2025', courseCode: 'SCS1213', courseName: 'Database Systems', description: 'Overall', type: 'Aggregating', mark: '86.00' }
      ],
      examResults: [
        { academicYear: '2025', part: '1', semester: '1', entryType: 'COURSE', courseCode: 'SMA1101', courseName: 'Calculus', mark: '68.00', classification: '2.1', credits: '12', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '1', entryType: 'COURSE', courseCode: 'SHP1105', courseName: 'Electricity and Magnetism', mark: '75.00', classification: '1', credits: '12', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '1', entryType: 'COURSE', courseCode: 'SCS1112', courseName: 'Fundamentals of Digital Electronics', mark: '75.00', classification: '1', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '1', entryType: 'COURSE', courseCode: 'SCS1101', courseName: 'Introduction to Computer Science and Programming', mark: '88.00', classification: '1', credits: '12', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '1', entryType: 'COURSE', courseCode: 'SMA1102', courseName: 'Linear Algebra', mark: '72.00', classification: '2.1', credits: '12', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '1', entryType: 'COURSE', courseCode: 'SCS1103', courseName: 'Operating Systems Concepts', mark: '62.00', classification: '2.2', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '2', entryType: 'COURSE', courseCode: 'SCS1216', courseName: 'Computer Architecture and Organisation', mark: '82.00', classification: '1', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '2', entryType: 'COURSE', courseCode: 'SCS1217', courseName: 'Data Structures and Algorithms', mark: '78.00', classification: '1', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '2', entryType: 'COURSE', courseCode: 'SCS1213', courseName: 'Database Systems', mark: '76.00', classification: '1', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '2', entryType: 'COURSE', courseCode: 'SCS1210', courseName: 'Discrete Mathematics', mark: '81.00', classification: '1', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '2', entryType: 'COURSE', courseCode: 'SCS1215', courseName: 'Ethics and Professionalism', mark: '80.00', classification: '1', credits: '10', remark: 'Pass' },
        { academicYear: '2025', part: '1', semester: '2', entryType: 'COURSE', courseCode: 'SCS1214', courseName: 'Software Engineering', mark: '89.00', classification: '1', credits: '10', remark: 'Pass' }
      ],
      ledger: [
        { date: '2026-04-25', type: 'PAYMENT', description: 'Tuition Fees', currencyCode: 'ZIG', amount: -7200, usdEquivalent: -285.51 },
        { date: '2026-01-22', type: 'PAYMENT', description: 'Tuition Fees', currencyCode: 'ZIG', amount: -2700, usdEquivalent: -105.51 },
        { date: '2025-12-31', type: 'PAYMENT', description: 'Debtors Rev Loss on Exchange Rate', currencyCode: 'ZIG', amount: -51.77, usdEquivalent: 0.0 },
        { date: '2025-12-24', type: 'PAYMENT', description: 'Tuition Fees', currencyCode: 'ZIG', amount: -6920, usdEquivalent: -265.15 },
        { date: '2026-04-26', type: 'INVOICE', description: 'UG-P2SP1-SCS-2025-BYO-1-Y2-S1', currencyCode: 'USD', amount: 745, usdEquivalent: 745 },
        { date: '2025-11-06', type: 'INVOICE', description: 'UG-P2SP1-SCS-2025-BYO-1-Y1-S2', currencyCode: 'USD', amount: 745, usdEquivalent: 745 },
        { date: '2025-10-23', type: 'PAYMENT', description: 'Fees', currencyCode: 'USD', amount: -271.56, usdEquivalent: -271.56 },
        { date: '2025-03-25', type: 'INVOICE', description: 'UG-P2SP1-SCS-2025-BYO-1-Y1-S1', currencyCode: 'USD', amount: 745, usdEquivalent: 745 }
      ],
      createdAt: '2026-05-29'
    };

    studentsCache = Array.isArray(window.__PORTAL_BOOTSTRAP__?.students) && window.__PORTAL_BOOTSTRAP__.students.length
      ? window.__PORTAL_BOOTSTRAP__.students.map(normalizeStudent)
      : [normalizeStudent(defaultStudent)];

    let currentRole = 'student';
    let currentStudent = null;

    function escapeHtml(value) {
      return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#39;');
    }

    function formatMoney(amount) {
      return Number(amount || 0).toFixed(2);
    }

    function todayStamp() {
      return new Date().toISOString().slice(0, 10);
    }

    function normalizeAddress(value) {
      if (Array.isArray(value)) return value.map(part => String(part).trim()).filter(Boolean);
      if (typeof value === 'string' && value.trim()) {
        return value.split(',').map(part => part.trim()).filter(Boolean);
      }
      return [];
    }

    function normalizeStudent(student) {
      const normalized = {
        ...student,
        studentNumber: String(student.studentNumber || '').trim().toUpperCase(),
        password: String(student.password || ''),
        fullName: String(student.fullName || student.givenNames || '').trim(),
        surname: String(student.surname || '').trim(),
        givenNames: String(student.givenNames || student.fullName || '').trim(),
        gender: String(student.gender || '').trim(),
        nationalId: String(student.nationalId || '').trim(),
        dateOfBirth: String(student.dateOfBirth || '').trim(),
        placeOfBirth: String(student.placeOfBirth || '').trim(),
        programme: String(student.programme || '').trim(),
        programmeCode: String(student.programmeCode || '').trim(),
        email: String(student.email || '').trim(),
        phone: String(student.phone || '').trim(),
        addressLines: normalizeAddress(student.addressLines || student.address),
        currentAcademicYear: String(student.currentAcademicYear || '2026').trim(),
        currentPart: String(student.currentPart || '1').trim(),
        currentSemester: String(student.currentSemester || '1').trim(),
        transcriptCleared: String(student.transcriptCleared || 'No').trim(),
        feesPaid: Number(student.feesPaid || 0),
        paymentPlan: String(student.paymentPlan || 'You are not on Payment Plan!'),
        libraryFines: String(student.libraryFines || ''),
        itemsOwed: String(student.itemsOwed || ''),
        registrationHistory: Array.isArray(student.registrationHistory) ? student.registrationHistory.map(entry => ({
          academicYear: String(entry.academicYear || '').trim(),
          part: String(entry.part || '').trim(),
          semester: String(entry.semester || '').trim(),
          registeredAt: String(entry.registeredAt || '').trim(),
          courses: Array.isArray(entry.courses) ? entry.courses.map(course => ({
            courseCode: String(course.courseCode || '').trim(),
            courseName: String(course.courseName || '').trim(),
            type: String(course.type || '').trim()
          })) : []
        })) : [],
        courses: Array.isArray(student.courses) ? student.courses.map(course => ({
          courseCode: String(course.courseCode || '').trim(),
          courseName: String(course.courseName || '').trim(),
          type: String(course.type || '').trim()
        })) : [],
        continuousAssessment: Array.isArray(student.continuousAssessment) ? student.continuousAssessment.map(entry => ({
          academicYear: String(entry.academicYear || '').trim(),
          courseCode: String(entry.courseCode || '').trim(),
          courseName: String(entry.courseName || '').trim(),
          description: String(entry.description || '').trim(),
          type: String(entry.type || '').trim(),
          mark: String(entry.mark ?? '').trim()
        })) : [],
        examResults: Array.isArray(student.examResults) ? student.examResults.map(entry => ({
          academicYear: String(entry.academicYear || '').trim(),
          part: String(entry.part || '').trim(),
          semester: String(entry.semester || '').trim(),
          entryType: String(entry.entryType || '').trim(),
          courseCode: String(entry.courseCode || '').trim(),
          courseName: String(entry.courseName || '').trim(),
          mark: String(entry.mark ?? '').trim(),
          classification: String(entry.classification || '').trim(),
          credits: String(entry.credits || '').trim(),
          remark: String(entry.remark || '').trim()
        })) : [],
        ledger: Array.isArray(student.ledger) ? student.ledger.map(entry => ({
          date: String(entry.date || todayStamp()).trim(),
          type: String(entry.type || '').trim(),
          description: String(entry.description || '').trim(),
          currencyCode: String(entry.currencyCode || '').trim(),
          amount: Number(entry.amount || 0),
          usdEquivalent: Number(entry.usdEquivalent || 0)
        })) : [],
        createdAt: String(student.createdAt || todayStamp()).trim()
      };

      if (!normalized.fullName) {
        normalized.fullName = normalized.givenNames || normalized.surname || normalized.studentNumber;
      }

      return normalized;
    }

    function getStoredStudents() {
      if (Array.isArray(studentsCache) && studentsCache.length) {
        return studentsCache.map(normalizeStudent);
      }
      return [normalizeStudent(defaultStudent)];
    }

    function saveStudents(students) {
      const payload = students.map(normalizeStudent);
      studentsCache = payload;
      fetch(`${PORTAL_API}?action=syncStudents`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ students: payload })
      }).catch(() => {});
    }

    function getStudents() {
      return getStoredStudents().map(normalizeStudent);
    }

    function setStudents(students) {
      const normalized = students.map(normalizeStudent);
      saveStudents(normalized);
      return normalized;
    }

    function findStudent(identifier) {
      const lookup = String(identifier || '').trim().toUpperCase();
      return getStudents().find(student => student.studentNumber === lookup) || null;
    }

    function getStudentStatus(student) {
      const feesPaid = Number(student.feesPaid || 0);
      const balance = TOTAL_FEES - feesPaid;
      return {
        feesPaid,
        balance,
        canRegister: feesPaid >= REGISTRATION_THRESHOLD,
        canViewResults: feesPaid >= TOTAL_FEES
      };
    }

    function buildName(student) {
      return student.fullName || [student.givenNames, student.surname].filter(Boolean).join(' ').trim() || student.studentNumber;
    }

    function renderAddressLines(student) {
      const lines = student.addressLines.length ? student.addressLines : ['Address not provided'];
      return lines.map(line => `<div>${escapeHtml(line)}</div>`).join('');
    }

    function renderStudentProfile(student) {
      const status = getStudentStatus(student);
      studentProfileName.textContent = buildName(student).toUpperCase();
      studentPersonalCopy.innerHTML = `
        <h3>${escapeHtml(buildName(student))}</h3>
        <p class="id-line">ID Number: ${escapeHtml(student.nationalId || student.studentNumber)}</p>
        ${renderAddressLines(student)}
        <p>Phone Number: ${escapeHtml(student.phone || 'Not provided')}</p>
        <p>Gender: ${escapeHtml(student.gender || 'Not provided')}</p>
        <p>Email: ${escapeHtml(student.email || 'Not provided')}</p>
      `;

      studentCoursesBody.innerHTML = student.courses.length
        ? student.courses.map(course => `<tr><td>${escapeHtml(course.courseCode)}</td><td>${escapeHtml(course.courseName)}</td><td>${escapeHtml(course.type || 'CORE')}</td></tr>`).join('')
        : '<tr><td colspan="3">No registered courses yet.</td></tr>';

      studentAcademicRows.innerHTML = `
        <tr><td>Student Number:</td><td>${escapeHtml(student.studentNumber)}</td></tr>
        <tr><td>Programme:</td><td>${escapeHtml(student.programme || 'Not provided')}</td></tr>
        <tr><td>Registration Status:</td><td class="${status.canRegister ? 'warn' : 'pending'}">${status.canRegister ? 'REGISTERED' : 'PENDING PAYMENT'}</td></tr>
        <tr><td>CERTIFICATE AND TRANSCRIPT CLEARED:</td><td>${escapeHtml(student.transcriptCleared || 'No')}</td></tr>
        <tr><td>Current Academic Year:</td><td>${escapeHtml(student.currentAcademicYear)}</td></tr>
        <tr><td>Current Part:</td><td>${escapeHtml(student.currentPart)}</td></tr>
        <tr><td>Current Semester:</td><td>${escapeHtml(student.currentSemester)}</td></tr>
      `;

      studentFinancialRows.innerHTML = `
        <tr><td>Overall Fees Balance:</td><td>USD ${formatMoney(status.balance)}</td></tr>
        <tr><td>Payment Plan:</td><td>${escapeHtml(student.paymentPlan)}</td></tr>
        <tr><td>Library Fines:</td><td>${escapeHtml(student.libraryFines)}</td></tr>
        <tr><td>Items Owed At The Library:</td><td>${escapeHtml(student.itemsOwed)}</td></tr>
      `;

      if (studentFinancialCallout) {
        studentFinancialCallout.textContent = status.canRegister
          ? 'This student is cleared to register for the next semester once the portal process is opened.'
          : 'Students are advised to clear at least 50% of the semester fees before they can register.';
      }

      if (paymentsBalanceLine) {
        paymentsBalanceLine.innerHTML = `Overall Balance: <strong>USD ${formatMoney(status.balance)}</strong>`;
      }

      zigPaymentsBody.innerHTML = student.ledger
        .filter(entry => entry.currencyCode === 'ZIG')
        .map(entry => `<tr><td>${escapeHtml(entry.date)}</td><td>${escapeHtml(entry.type)}</td><td>${escapeHtml(entry.description)}</td><td>${escapeHtml(entry.currencyCode)}</td><td>${escapeHtml(entry.amount)}</td><td>${escapeHtml(entry.usdEquivalent)}</td></tr>`)
        .join('') || '<tr><td colspan="6">No ZIG entries yet.</td></tr>';

      usdPaymentsBody.innerHTML = student.ledger
        .filter(entry => entry.currencyCode === 'USD')
        .map(entry => `<tr><td>${escapeHtml(entry.date)}</td><td>${escapeHtml(entry.type)}</td><td>${escapeHtml(entry.description)}</td><td>${escapeHtml(entry.currencyCode)}</td><td>${escapeHtml(entry.amount)}</td><td>${escapeHtml(entry.usdEquivalent)}</td></tr>`)
        .join('') || '<tr><td colspan="6">No USD entries yet.</td></tr>';

      const profileMarkup = `
        <div class="profile-col details">
          <table class="result-details">
            <tr><td><strong>Surname:</strong></td><td>${escapeHtml(student.surname || buildName(student).split(' ').slice(-1)[0] || '')}</td></tr>
            <tr><td><strong>Name(s):</strong></td><td>${escapeHtml(student.givenNames || buildName(student))}</td></tr>
            <tr><td><strong>Gender:</strong></td><td>${escapeHtml(student.gender || 'Not provided')}</td></tr>
            <tr><td><strong>National ID#:</strong></td><td>${escapeHtml(student.nationalId || 'Not provided')}</td></tr>
            <tr><td><strong>Date Of Birth:</strong></td><td>${escapeHtml(student.dateOfBirth || 'Not provided')}</td></tr>
            <tr><td><strong>Place Of Birth</strong>:</td><td>${escapeHtml(student.placeOfBirth || 'Not provided')}</td></tr>
            <tr><td><strong>Programme</strong>:</td><td>${escapeHtml(student.programme || 'Not provided')}</td></tr>
          </table>
        </div>
        <div class="profile-col address">
          <div class="address-title">Address and Contact Details</div>
          ${renderAddressLines(student)}
          <div style="margin-top:8px"><strong>Telephone</strong> :${escapeHtml(student.phone || 'Not provided')}</div>
        </div>
        <div class="profile-col idcrest">
          <div class="student-id">${escapeHtml(student.studentNumber)}</div>
          <img src="logo_nust_png.png" alt="Student crest" class="detail-logo" />
        </div>
      `;

      resultsProfileBody.innerHTML = profileMarkup;
      assessmentProfileBody.innerHTML = profileMarkup;

      if (resultsAccessNotice) {
        resultsAccessNotice.innerHTML = status.canViewResults
          ? '<strong>Results unlocked.</strong> Full semester fees have been cleared.'
          : `<strong>Results locked.</strong> Pay the remaining USD ${formatMoney(status.balance)} to make examination results visible in the student portal.`;
      }

      const resultsWrap = resultsSection.querySelector('.results-table-wrap');
      if (resultsWrap) {
        resultsWrap.style.display = status.canViewResults ? '' : 'none';
      }

      studentResultsBody.innerHTML = status.canViewResults
        ? student.examResults.map(result => `<tr><td>${escapeHtml(result.academicYear)}</td><td>${escapeHtml(result.part)}</td><td>${escapeHtml(result.semester)}</td><td>${escapeHtml(result.entryType)}</td><td>${escapeHtml(result.courseCode)}</td><td>${escapeHtml(result.courseName)}</td><td>${escapeHtml(result.mark)}</td><td>${escapeHtml(result.classification)}</td><td>${escapeHtml(result.credits)}</td><td>${escapeHtml(result.remark)}</td></tr>`).join('')
        : '<tr><td colspan="10">Results are hidden until the student clears the full semester fee.</td></tr>';

      studentAssessmentBody.innerHTML = student.continuousAssessment.length
        ? student.continuousAssessment.map(entry => `<tr><td>${escapeHtml(entry.academicYear)}</td><td>${escapeHtml(entry.courseCode)}</td><td>${escapeHtml(entry.courseName)}</td><td>${escapeHtml(entry.description)}</td><td>${escapeHtml(entry.type)}</td><td>${escapeHtml(entry.mark)}</td></tr>`).join('')
        : '<tr><td colspan="6">No continuous assessment records uploaded yet.</td></tr>';

      document.getElementById('dashboardView').querySelector('.profile-name').textContent = buildName(student).toUpperCase();
      renderRegistrationSection(student);
    }

    function renderRegistrationSection(student, preserveSelection = false) {
      if (!registrationSection || !registrationForm || !registrationCourseList) return;

      registrationAcademicYear.value = student?.currentAcademicYear || '2026';
      renderRegistrationCourseOptions(student, preserveSelection);
    }

    function renderAdminPortal(students) {
      const normalizedStudents = students.map(normalizeStudent);
      adminStudentCount.textContent = String(normalizedStudents.length);
      adminClearedCount.textContent = String(normalizedStudents.filter(student => getStudentStatus(student).canViewResults).length);
      adminPendingCount.textContent = String(normalizedStudents.filter(student => !getStudentStatus(student).canViewResults).length);

      const optionMarkup = normalizedStudents.map(student => `<option value="${escapeHtml(student.studentNumber)}">${escapeHtml(student.studentNumber)} - ${escapeHtml(buildName(student))}</option>`).join('');
      feesStudentSelect.innerHTML = optionMarkup;
      assessmentStudentSelect.innerHTML = optionMarkup;
      resultsStudentSelect.innerHTML = optionMarkup;

      const rows = normalizedStudents.map(student => {
        const status = getStudentStatus(student);
        return `<tr><td>${escapeHtml(student.studentNumber)}</td><td>${escapeHtml(buildName(student))}</td><td>${escapeHtml(student.programme || 'Not provided')}</td><td>USD ${formatMoney(status.feesPaid)}</td><td>USD ${formatMoney(status.balance)}</td><td class="${status.canRegister ? 'warn' : 'pending'}">${status.canRegister ? 'REGISTERED' : 'PENDING PAYMENT'}</td><td class="${status.canViewResults ? 'warn' : 'pending'}">${status.canViewResults ? 'VISIBLE' : 'LOCKED'}</td></tr>`;
      }).join('');
      adminStudentsBody.innerHTML = rows || '<tr><td colspan="7">No student records found.</td></tr>';

      const feedItems = normalizedStudents
        .slice()
        .sort((a, b) => String(b.createdAt).localeCompare(String(a.createdAt)))
        .map(student => `<article class="admin-feed-item"><strong>${escapeHtml(buildName(student))}</strong><span>${escapeHtml(student.studentNumber)}</span><p>${escapeHtml(student.createdAt)}</p></article>`)
        .join('');
      adminSignupFeed.innerHTML = feedItems || '<p class="admin-empty">No signups yet.</p>';
    }

    function refreshCurrentPortal() {
      const students = getStudents();
      if (currentRole === 'admin') {
        renderAdminPortal(students);
      } else if (currentStudent) {
        renderStudentProfile(currentStudent);
        renderRegistrationSection(currentStudent);
      }
      enhanceAllTables();
    }

    function syncLoginMode() {
      const role = loginRole.value;
      currentRole = role;
      studentInput.placeholder = role === 'admin' ? 'Admin Username' : 'Student Number';
      studentInput.autocomplete = role === 'admin' ? 'username' : 'username';
      openSignupBtn.classList.toggle('is-hidden', role === 'admin');
    }

    function showSection(id) {
      if (!dashboardHome || !registrationSection || !paymentsSection || !resultsSection || !assessmentSection) return;
      dashboardView.classList.remove('registration-mode');
      dashboardHome.classList.add('is-hidden');
      registrationSection.classList.add('is-hidden');
      paymentsSection.classList.add('is-hidden');
      resultsSection.classList.add('is-hidden');
      assessmentSection.classList.add('is-hidden');

      if (id === 'registration') registrationSection.classList.remove('is-hidden');
      else if (id === 'payments') paymentsSection.classList.remove('is-hidden');
      else if (id === 'results') resultsSection.classList.remove('is-hidden');
      else if (id === 'assessment') assessmentSection.classList.remove('is-hidden');
      else dashboardHome.classList.remove('is-hidden');

      if (id === 'registration') {
        dashboardView.classList.add('registration-mode');
        dashboardHome.classList.remove('is-hidden');
        registrationSection.classList.remove('is-hidden');
      }

      document.querySelectorAll('#dashboardView .side-link').forEach(link => link.classList.remove('active'));
      const activeHash = id === 'dashboardHome' || id === 'dashboard' ? '#dashboard' : `#${id}`;
      const link = dashboardView.querySelector(`.side-link[href="${activeHash}"]`);
      if (link) link.classList.add('active');
      window.scrollTo({ top: 0, behavior: 'auto' });
    }

    function showStudentPortal(student) {
      currentRole = 'student';
      currentStudent = normalizeStudent(student);
      loginView.classList.add('is-hidden');
      adminView.classList.add('is-hidden');
      dashboardView.classList.remove('is-hidden');
      renderStudentProfile(currentStudent);
      showSection('dashboardHome');
      refreshCurrentPortal();
      window.scrollTo({ top: 0, behavior: 'auto' });
    }

    function showAdminPortal() {
      currentRole = 'admin';
      currentStudent = null;
      loginView.classList.add('is-hidden');
      dashboardView.classList.add('is-hidden');
      adminView.classList.remove('is-hidden');
      renderAdminPortal(getStudents());
      refreshCurrentPortal();
      window.scrollTo({ top: 0, behavior: 'auto' });
    }

    function showLogin() {
      currentStudent = null;
      currentRole = 'student';
      loginRole.value = 'student';
      syncLoginMode();
      loginView.classList.remove('is-hidden');
      dashboardView.classList.add('is-hidden');
      adminView.classList.add('is-hidden');
      loginForm.reset();
      closeSignupModal();
      window.scrollTo({ top: 0, behavior: 'auto' });
    }

    function openSignupModal() {
      signupModal.classList.remove('is-hidden');
      signupModal.setAttribute('aria-hidden', 'false');
      signupForm.querySelector('input')?.focus();
    }

    function closeSignupModal() {
      signupModal.classList.add('is-hidden');
      signupModal.setAttribute('aria-hidden', 'true');
      signupForm.reset();
    }

    async function handleSubmit(event) {
      event.preventDefault();
      const role = loginRole.value;
      const identifier = studentInput.value.trim();
      const password = passwordInput.value.trim();

      try {
        const response = await fetch(`${PORTAL_API}?action=login`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ role, identifier, password })
        });

        const result = await response.json();
        if (!response.ok || !result.ok) {
          alert(result.message || `Invalid ${role} login credentials.`);
          return;
        }

        if (result.role === 'admin') {
          showAdminPortal();
          return;
        }

        showStudentPortal(result.student || findStudent(identifier));
      } catch (error) {
        const student = findStudent(identifier);
        if (role === 'admin') {
          alert('Unable to reach the database for admin login.');
          return;
        }
        if (student) {
          showStudentPortal(student);
          return;
        }
        alert('Unable to reach the database for student login.');
      }
    }

    function openActionModal(type) {
      const config = actionConfigs[type];
      if (!config) return;

      modalTitle.textContent = config.title;
      modalIntro.textContent = config.intro;
      if (type === 'calendar') {
        modalFields.innerHTML = '<div class="download-box"><a class="download-link" href="downloads/nust-calendar-app.apk" download>Download NUST Calendar App</a><p class="download-note">This download link is ready for the calendar app package.</p></div>';
      } else {
        modalFields.innerHTML = config.fields.map(field => {
          if (field.type === 'textarea') {
            return `<label class="modal-field"><span>${escapeHtml(field.label)}</span><textarea name="${escapeHtml(field.name)}" placeholder="${escapeHtml(field.placeholder)}" ${field.required ? 'required' : ''}></textarea></label>`;
          }
          return `<label class="modal-field"><span>${escapeHtml(field.label)}</span><input name="${escapeHtml(field.name)}" type="${escapeHtml(field.type)}" placeholder="${escapeHtml(field.placeholder)}" ${field.required ? 'required' : ''} ${field.min ? `min="${escapeHtml(field.min)}"` : ''} ${field.step ? `step="${escapeHtml(field.step)}"` : ''}></label>`;
        }).join('');
      }

      actionForm.dataset.mode = type;
      actionModal.classList.remove('is-hidden');
      actionModal.setAttribute('aria-hidden', 'false');
      actionForm.querySelector('input, textarea')?.focus();
    }

    function closeActionModal() {
      actionModal.classList.add('is-hidden');
      actionModal.setAttribute('aria-hidden', 'true');
      actionForm.reset();
    }

    function exportSectionToPdf(targetSelector) {
      const target = document.querySelector(targetSelector);
      if (!target) return window.print();

      const clone = target.cloneNode(true);
      clone.querySelectorAll('.table-controls, .table-nav').forEach(node => node.remove());
      clone.style.background = '#ffffff';
      clone.style.color = '#000000';
      clone.querySelectorAll('*').forEach(el => {
        el.style.color = '#000000';
      });

      if (window.jspdf && window.jspdf.jsPDF) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ unit: 'pt', format: 'a4', orientation: 'landscape' });
        doc.html(clone, {
          x: 24,
          y: 24,
          html2canvas: { scale: 0.7, backgroundColor: '#ffffff' },
          callback: function () {
            doc.save('export.pdf');
          }
        });
        return;
      }

      window.print();
    }

    function enhanceAllTables() {
      document.querySelectorAll('table.enhance-table').forEach(table => {
        if (table.dataset.enhanced) return;
        table.dataset.enhanced = '1';
        const wrapper = document.createElement('div');
        wrapper.className = 'table-controls';
        const search = document.createElement('input');
        search.type = 'search';
        search.placeholder = 'Search table...';
        search.className = 'table-search';
        wrapper.appendChild(search);

        const filterField = document.createElement('select');
        filterField.className = 'table-filter-field';
        const allOption = document.createElement('option');
        allOption.value = 'all';
        allOption.textContent = 'All columns';
        filterField.appendChild(allOption);
        Array.from(table.tHead.rows[0].cells).forEach((cell, index) => {
          const option = document.createElement('option');
          option.value = String(index);
          option.textContent = cell.textContent.trim();
          filterField.appendChild(option);
        });
        wrapper.appendChild(filterField);

        const pageSizeSelect = document.createElement('select');
        [10, 25, 50, 100].forEach(n => {
          const option = document.createElement('option');
          option.value = n;
          option.text = n;
          pageSizeSelect.appendChild(option);
        });
        pageSizeSelect.value = 10;
        pageSizeSelect.className = 'table-pagesize';
        wrapper.appendChild(pageSizeSelect);

        table.parentNode.insertBefore(wrapper, table);

        const rows = Array.from(table.tBodies[0].rows);
        let page = 1;
        let sortColumn = -1;
        let sortDirection = 1;

        function render() {
          const q = search.value.trim().toLowerCase();
          const pageSize = parseInt(pageSizeSelect.value, 10);
          const selectedField = filterField.value;
          const filtered = rows.filter(row => {
            if (!q) return true;
            const cells = Array.from(row.cells);
            if (selectedField === 'all') return row.innerText.toLowerCase().includes(q);
            const cell = cells[parseInt(selectedField, 10)];
            return (cell ? cell.innerText : '').toLowerCase().includes(q);
          }).sort((a, b) => {
            if (sortColumn < 0) return 0;
            const aValue = (a.cells[sortColumn]?.innerText || '').trim();
            const bValue = (b.cells[sortColumn]?.innerText || '').trim();
            const aNumber = parseFloat(aValue.replace(/[^0-9.-]/g, ''));
            const bNumber = parseFloat(bValue.replace(/[^0-9.-]/g, ''));
            const numeric = !Number.isNaN(aNumber) && !Number.isNaN(bNumber);
            if (numeric) return (aNumber - bNumber) * sortDirection;
            return aValue.localeCompare(bValue) * sortDirection;
          });

          const totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
          if (page > totalPages) page = totalPages;
          rows.forEach(row => { row.style.display = 'none'; });
          const start = (page - 1) * pageSize;
          filtered.slice(start, start + pageSize).forEach(row => { row.style.display = 'table-row'; });

          let pager = wrapper.querySelector('.table-pager');
          if (!pager) {
            pager = document.createElement('div');
            pager.className = 'table-pager';
            wrapper.appendChild(pager);
          }
          pager.innerHTML = `Page ${page} of ${totalPages}`;
        }

        search.addEventListener('input', () => { page = 1; render(); });
        filterField.addEventListener('change', () => { page = 1; render(); });
        pageSizeSelect.addEventListener('change', () => { page = 1; render(); });
        wrapper.addEventListener('click', event => {
          if (event.target.classList.contains('page-prev')) {
            page = Math.max(1, page - 1);
            render();
          }
          if (event.target.classList.contains('page-next')) {
            page += 1;
            render();
          }
        });

        const nav = document.createElement('div');
        nav.className = 'table-nav';
        nav.innerHTML = '<button class="page-prev">Prev</button> <button class="page-next">Next</button>';
        wrapper.appendChild(nav);

        Array.from(table.tHead.rows[0].cells).forEach((cell, index) => {
          cell.classList.add('sortable-col');
          cell.addEventListener('click', () => {
            if (sortColumn === index) sortDirection *= -1;
            else {
              sortColumn = index;
              sortDirection = 1;
            }
            render();
          });
        });

        render();
      });
    }

    function renderSelectedStudentFromForm() {
      const selected = findStudent(studentInput.value.trim());
      if (selected) {
        currentStudent = selected;
      }
    }

    function appendLedgerEntry(student, entry) {
      const next = normalizeStudent(student);
      next.ledger.unshift(entry);
      return next;
    }

    function appendAssessmentEntry(student, entry) {
      const next = normalizeStudent(student);
      next.continuousAssessment.unshift(entry);
      return next;
    }

    function appendResultEntry(student, entry) {
      const next = normalizeStudent(student);
      next.examResults.unshift(entry);
      return next;
    }

    function handleFeesSubmit(event) {
      event.preventDefault();
      const studentNumber = feesStudentSelect.value;
      const currencyCode = String(feesCurrency?.value || 'USD').toUpperCase();
      const amount = Number(feesAmount.value);
      if (!studentNumber || !amount || amount <= 0) {
        alert('Select a student and enter a valid payment amount.');
        return;
      }

      const exchangeRate = 35;
      const usdEquivalent = currencyCode === 'ZIG' ? amount / exchangeRate : amount;
      const recordedAmount = currencyCode === 'ZIG' ? amount : amount;

      const students = getStudents();
      const index = students.findIndex(student => student.studentNumber === studentNumber);
      if (index < 0) return;

      const updated = normalizeStudent(students[index]);
      updated.feesPaid = Number(updated.feesPaid || 0) + usdEquivalent;
      updated.ledger = [{
        date: todayStamp(),
        type: 'PAYMENT',
        description: feesReference.value.trim() || 'Fees payment update',
        currencyCode,
        amount: -recordedAmount,
        usdEquivalent: -usdEquivalent
      }, ...updated.ledger];

      students[index] = updated;
      setStudents(students);
      feesForm.reset();
      if (feesCurrency) {
        feesCurrency.value = 'USD';
      }
      renderAdminPortal(students);
      if (currentRole === 'student' && currentStudent && currentStudent.studentNumber === updated.studentNumber) {
        currentStudent = updated;
        renderStudentProfile(updated);
      }
      enhanceAllTables();
      alert(`Fees updated for ${updated.studentNumber}. ${currencyCode === 'ZIG' ? `Converted at 35 ZIG = USD 1.00.` : ''}`.trim());
    }

    function handleRegistrationSubmit(event) {
      event.preventDefault();
      if (!currentStudent) return;

      const students = getStudents();
      const index = students.findIndex(student => student.studentNumber === currentStudent.studentNumber);
      if (index < 0) return;

      const selectedCourses = Array.from(registrationCourseList.querySelectorAll('input[type="checkbox"]:checked'))
        .map(input => getRegistrationCatalog(registrationPart?.value, registrationSemester?.value).find(course => course.courseCode === input.value))
        .filter(Boolean)
        .map(course => ({ ...course }));

      if (!selectedCourses.length) {
        alert('Select at least one course before registering the semester.');
        return;
      }

      const updated = normalizeStudent(students[index]);
      updated.currentAcademicYear = registrationAcademicYear.value.trim() || updated.currentAcademicYear;
      updated.currentPart = registrationPart.value.trim() || updated.currentPart;
      updated.currentSemester = registrationSemester.value.trim() || updated.currentSemester;
      updated.courses = selectedCourses;
      updated.registrationHistory = Array.isArray(updated.registrationHistory) ? updated.registrationHistory : [];
      updated.registrationHistory.unshift({
        academicYear: updated.currentAcademicYear,
        part: updated.currentPart,
        semester: updated.currentSemester,
        courses: selectedCourses,
        registeredAt: todayStamp()
      });

      students[index] = updated;
      setStudents(students);
      currentStudent = updated;
      renderStudentProfile(updated);
      renderRegistrationSection(updated);
      renderAdminPortal(students);
      enhanceAllTables();
      alert(`Semester ${updated.currentSemester} registered successfully.`);
    }

    function handleAssessmentSubmit(event) {
      event.preventDefault();
      const studentNumber = assessmentStudentSelect.value;
      if (!studentNumber) return;
      const students = getStudents();
      const index = students.findIndex(student => student.studentNumber === studentNumber);
      if (index < 0) return;

      const updated = appendAssessmentEntry(students[index], {
        academicYear: assessmentYear.value.trim(),
        courseCode: assessmentCourseCode.value.trim(),
        courseName: assessmentCourseName.value.trim(),
        description: assessmentDescription.value.trim(),
        type: assessmentType.value.trim(),
        mark: assessmentMark.value.trim()
      });

      students[index] = updated;
      setStudents(students);
      assessmentForm.reset();
      renderAdminPortal(students);
      if (currentRole === 'student' && currentStudent && currentStudent.studentNumber === updated.studentNumber) {
        currentStudent = updated;
        renderStudentProfile(updated);
      }
      enhanceAllTables();
      alert('Continuous assessment uploaded.');
    }

    function handleResultsSubmit(event) {
      event.preventDefault();
      const studentNumber = resultsStudentSelect.value;
      if (!studentNumber) return;
      const students = getStudents();
      const index = students.findIndex(student => student.studentNumber === studentNumber);
      if (index < 0) return;

      const updated = appendResultEntry(students[index], {
        academicYear: resultsYear.value.trim(),
        part: resultsPart.value.trim(),
        semester: resultsSemester.value.trim(),
        entryType: resultsEntryType.value.trim(),
        courseCode: resultsCourseCode.value.trim(),
        courseName: resultsCourseName.value.trim(),
        mark: resultsMark.value.trim(),
        classification: resultsClassification.value.trim(),
        credits: resultsCredits.value.trim(),
        remark: resultsRemark.value.trim()
      });

      students[index] = updated;
      setStudents(students);
      resultsForm.reset();
      renderAdminPortal(students);
      if (currentRole === 'student' && currentStudent && currentStudent.studentNumber === updated.studentNumber) {
        currentStudent = updated;
        renderStudentProfile(updated);
      }
      enhanceAllTables();
      alert('Examination result uploaded.');
    }

    function handleSignupSubmit(event) {
      event.preventDefault();
      const data = Object.fromEntries(new FormData(signupForm).entries());
      const studentNumber = String(data.studentNumber || '').trim().toUpperCase();
      const password = String(data.password || '').trim();
      const fullName = String(data.fullName || '').trim();
      const email = String(data.email || '').trim();

      if (!studentNumber || !password || !fullName || !email) {
        alert('Complete all required signup fields.');
        return;
      }

      const students = getStudents();
      if (students.some(student => student.studentNumber === studentNumber)) {
        alert('That student number is already registered.');
        return;
      }

      const nextStudent = normalizeStudent({
        studentNumber,
        password,
        fullName,
        givenNames: fullName,
        surname: fullName.split(' ').slice(-1)[0] || fullName,
        nationalId: String(data.nationalId || '').trim(),
        dateOfBirth: String(data.dateOfBirth || '').trim(),
        placeOfBirth: String(data.placeOfBirth || '').trim(),
        email,
        phone: String(data.phone || '').trim(),
        programme: String(data.programme || '').trim(),
        gender: String(data.gender || '').trim(),
        addressLines: normalizeAddress(String(data.address || '').trim()),
        feesPaid: 0,
        currentAcademicYear: '2026',
        currentPart: '1',
        currentSemester: '1',
        transcriptCleared: 'No',
        paymentPlan: 'You are not on Payment Plan!',
        createdAt: todayStamp(),
        courses: [],
        continuousAssessment: [],
        examResults: [],
        ledger: [{
          date: todayStamp(),
          type: 'INVOICE',
          description: 'New Student Registration Invoice',
          currencyCode: 'USD',
          amount: TOTAL_FEES,
          usdEquivalent: TOTAL_FEES
        }]
      });

      students.unshift(nextStudent);
      setStudents(students);
      closeSignupModal();
      loginRole.value = 'student';
      studentInput.value = nextStudent.studentNumber;
      passwordInput.value = nextStudent.password;
      syncLoginMode();
      renderAdminPortal(students);
      alert('Student account created. You can now log in with the new credentials.');
      enhanceAllTables();
    }

    if (menuToggle) {
      menuToggle.addEventListener('click', () => {
        document.body.classList.toggle('sidebar-collapsed');
      });
    }

    if (loginRole) {
      loginRole.addEventListener('change', syncLoginMode);
      syncLoginMode();
    }

    registrationPart?.addEventListener('change', () => {
      if (currentStudent) renderRegistrationSection(currentStudent, true);
    });

    registrationSemester?.addEventListener('change', () => {
      if (currentStudent) renderRegistrationSection(currentStudent, true);
    });

    openSignupBtn?.addEventListener('click', openSignupModal);
    closeSignupBtn?.addEventListener('click', closeSignupModal);
    cancelSignupBtn?.addEventListener('click', closeSignupModal);
    signupModal?.addEventListener('click', event => {
      if (event.target === signupModal) closeSignupModal();
    });
    signupForm?.addEventListener('submit', handleSignupSubmit);

    loginForm?.addEventListener('submit', handleSubmit);

    document.querySelectorAll('#dashboardView .side-link').forEach(link => {
      link.addEventListener('click', event => {
        event.preventDefault();
        const href = link.getAttribute('href') || '';
        if (/^https?:\/\//.test(href)) {
          window.open(href, '_blank', 'noopener,noreferrer');
          return;
        }
        const id = href.replace('#', '');
        if (id === 'registration') showSection('registration');
        else if (id === 'payments') showSection('payments');
        else if (id === 'results') showSection('results');
        else if (id === 'assessment') showSection('assessment');
        else showSection('dashboardHome');
      });
    });

    document.querySelectorAll('.action-card').forEach(card => {
      card.addEventListener('click', () => {
        const type = card.dataset.action;
        if (type) openActionModal(type);
      });
    });

    document.getElementById('closeModalBtn')?.addEventListener('click', closeActionModal);
    document.getElementById('cancelModalBtn')?.addEventListener('click', closeActionModal);
    actionModal?.addEventListener('click', event => {
      if (event.target === actionModal) closeActionModal();
    });
    actionForm?.addEventListener('submit', event => {
      event.preventDefault();
      const data = Object.fromEntries(new FormData(actionForm).entries());
      const type = actionForm.dataset.mode;
      const config = actionConfigs[type];
      if (!config) return;

      const result = config.submit(data);
      alert(result.message);
      if (result.ok) {
        closeActionModal();
      }
    });

    feesForm?.addEventListener('submit', handleFeesSubmit);
    registrationForm?.addEventListener('submit', handleRegistrationSubmit);
    assessmentForm?.addEventListener('submit', handleAssessmentSubmit);
    resultsForm?.addEventListener('submit', handleResultsSubmit);

    document.querySelectorAll('.export-btn').forEach(button => {
      button.addEventListener('click', () => {
        exportSectionToPdf(button.dataset.target || '.dashboard');
      });
    });

    const seedStudents = getStudents();
    renderAdminPortal(seedStudents);
    renderStudentProfile(seedStudents[0]);
    enhanceAllTables();
    showSection('dashboardHome');
  </script>
</body>
</html>
