<?php

function autoloadModel($className)
{
    $filename = "class/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");

if (!isset($_COOKIE['logged_in'])) {
    header("Location: ./login.php");
}

User::handleForm();

User::logout();

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="en">

    <title>lastSeen | Profile</title>

    <link rel="stylesheet" type="text/css" href="css/master.css">
</head>

<body>
    <div class="view">
        <header id="global-header">
            <nav class="nav-bar container" role="navigation">
                <div class="branding" title="Return to the home page">
                    <a href="./index.php" class="branding-content">
                        <img src="./svg/logo.svg" alt="">
                        <span class="str-only">lastSeen</span>
                    </a>
                </div>
                <div id="container-nav" class="nav-container">
                    <ul class="global-nav nav-group">
                        <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                            <a href="./dashboard.php" class="selection nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                            <a href="./contacts.php" class="selection nav-link">Contacts</a>
                        </li>
                        <li class="nav-item selected" data-log-category="dashboard" data-log-page="dashboard">
                            <a href="./profile.php" class="selection nav-link">Profile</a>
                        </li>
                        <?php

                        if (isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1) {
                            echo '<li class="nav-item" data-log-category="dashboard" data-log-page="dashboard">
                            <a href="./admin.php" class="selection nav-link">Admin</a></li>';
                        }
                        ?>
                    </ul>
                    <ul class="user-nav nav-group">
                        <li class="nav-object-group">
                            <div class="nav-item logged-out-nav">
                                <a href="?edit" class="btn btn-primary btn-login" type="sumbit" name="edit">Edit</a>
                            </div>
                            <div class="nav-item logged-out-nav">
                                <a href="?logout" class="btn btn-primary btn-signup" type="sumbit" name="logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="page container">
            <div class="row">
                <!--
                <div class="profile-heading profile section">
                    <div class="avatar avatar-xl">
                        <div class="avatar-content">
                            <div class="avatar-img-wrapper">
                                <img class="avatar-img" src="./svg/avatar.svg" alt="avatar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="spans5">
                            <h1 class="text-title1 profile-name"><?php echo $_COOKIE['f_name'] . " " . $_COOKIE['l_name'] ?></h1>
                            <div class="location">
                                <div class="app-icon icon-location icon-xs"></div>
                                Brno, Czech Republic
                            </div>
                        </div>
                        <div class="spans10">
                            <section class="activity-summary">
                                <div class="activity-count">
                                    <h3 class="count-header">Last 4 Weeks</h3>
                                    <div class="count-total">
                                        <div class="count text-display5"><?php echo Meeting::getMeetingsCountLast4Weeks() ?></div>
                                        <div class="count-label">Total Meetings</div>
                                    </div>
                                </div>
                                <div class="activity-count">
                                    <h3 class="count-header">Last 4 Weeks</h3>
                                    <div class="count-total">
                                        <div class="count text-display5"><?php echo Meeting::getAllDurationForLastWeek() ?></div>
                                        <div class="count-label">Total Minutes</div>
                                    </div>
                                </div>
                                <div class="activity-calendar">
                                    <h3 class="vh">Calendar</h3>
                                    <table>
                                        <caption class="vh">Last four weeks of activity</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div class="weekday">M</div>
                                                </th>
                                                <th scope="col">
                                                    <div class="weekday">T</div>
                                                </th>
                                                <th scope="col">
                                                    <div class="weekday">W</div>
                                                </th>
                                                <th scope="col">
                                                    <div class="weekday">T</div>
                                                </th>
                                                <th scope="col">
                                                    <div class="weekday">F</div>
                                                </th>
                                                <th scope="col">
                                                    <div class="weekday">S</div>
                                                </th>
                                                <th scope="col">
                                                    <div class="weekday">S</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                                <td class="day-wrapper">
                                                    <span class="day">30</span>
                                                    <span class="activity-indicator"></span>
                                                    <div class="vh"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="activity-breakdown">
                                    <figure>
                                        <figcaption>
                                            <dl class="legend">
                                                <dt class="label"></dt>
                                                <dd>
                                                    <div class="app-icon icon-sm icon-dark icon-ride-v3" title="Cycling">
                                                        <div class="vh">Cycling</div>
                                                    </div>
                                                </dd>
                                                <dt class="label"></dt>
                                                <dd>
                                                    <div class="app-icon icon-sm icon-dark icon-ride-v3" title="Cycling">
                                                        <div class="vh">Cycling</div>
                                                    </div>
                                                </dd>
                                                <dt class="label"></dt>
                                                <dd>
                                                    <div class="app-icon icon-sm icon-dark icon-ride-v3" title="Cycling">
                                                        <div class="vh">Cycling</div>
                                                    </div>
                                                </dd>
                                                <dt class="label"></dt>
                                                <dd>
                                                    <div class="app-icon icon-sm icon-dark icon-ride-v3" title="Cycling">
                                                        <div class="vh">Cycling</div>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </figcaption>
                                        <div class="week-breakdown">
                                            <dt class="week vh"></dt>
                                            <dd class="hours">
                                                <div class="no-activity vh"></div>
                                            </dd>
                                            <dt class="week vh"></dt>
                                            <dd class="hours">
                                                <div class="no-activity vh"></div>
                                            </dd>
                                            <dt class="week vh"></dt>
                                            <dd class="hours">
                                                <div class="no-activity vh"></div>
                                            </dd>
                                            <dt class="week vh"></dt>
                                            <dd class="hours">
                                                <div class="no-activity vh"></div>
                                            </dd>
                                        </div>
                                    </figure>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                -->
                <div id="dashboard-feed" class="main col-lg-6 col-md-8">
                    <div class="feed-container">
                        <?php echo User::renderUser($_COOKIE['uid']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>