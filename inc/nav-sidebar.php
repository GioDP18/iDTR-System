<?php 
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?= $firstname." ".substr($middlename, 0, 1).". ".$lastname; ?>
                            <span class="user-level">Intern</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item <?= $currentPage=='index.php' ? 'active':'' ?>">
                    <a href="index.php" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Monitoring</h4>
                </li>
                <li class="nav-item <?= $currentPage=='timeLog_am.php' || $currentPage=='timeLog_pm.php' ? 'active':'' ?>">
                    <a data-toggle="collapse" href="#timeLog" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clock"></i>
                        <p>Time Log</p>
						<span class="caret"></span>
                    </a>
                    <div class="collapses" id="timeLog">
                        <ul class="nav nav-collapse" >
                            <li class=" <?= $currentPage=='timeLog_am.php' ? 'active':'' ?>">
                                <a href="timeLog_am.php">
                                    <span class="sub-item">AM</span>
                                </a>
                            </li>
                            <li class=" <?= $currentPage=='timeLog_pm.php' ? 'active':'' ?>">
                                <a href="timeLog_pm.php">
                                    <span class="sub-item">PM</span>
                                </a>
                            </li>
                            <li class=" <?= $currentPage=='summary.php' ? 'active':'' ?>">
                                <a href="summary.php">
                                    <span class="sub-item">Summary</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?= $currentPage=='reports.php' ? 'active':'' ?>">
                    <a href="reports.php">
                        <i class="fas fa-pen"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</div>