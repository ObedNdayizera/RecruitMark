<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FC</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .logos_container{
            display: flex;
        }
        .profile {
            width: 20px;
            height: 20px;
            background: #f4f4f4;
            padding: 5px;
            border-radius: 50%;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .logo {
            padding-right: 10px;
            width: 40px;
            height: 40px;
            margin-top: -10px;
        }
        .title_beauty {
            font-weight: 900;
            font-size: 15px;
            margin-bottom: -20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logos_container">
            <img class="logo" src="images/logo.png" alt="BEAUTY WAREHOUSE">
            <small class="title_beauty">BEAUTY WAREHOUSE</small>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_candidates.php">Manage Candidates</a></li>
                <li><a href="view_posts.php">Manage Posts</a></li>
                <li><a href="view_candidate_result.php">Manage Candidate Results</a></li>
                <li><a href="report.php">Generate Report</a></li>
            </ul>
        </nav>
        <a href="profile.php"><img class="profile" src="images/profile.svg" alt="profile"></a>
    </header>
    <main>
