<?php $this->load->view('part/head');?>

<body class="theme-dark">
<?php $this->load->view('/part/left_menu'); ?>
<?php $this->load->view('/part/top_menu'); ?>
<section class="page-content">
	<div class="page-content-inner">
		    <!-- Profile Header -->
    <nav class="top-submenu top-submenu-with-background">
        <div class="profile-header">
            <div class="profile-header-info">
                <div class="row">
                    <div class="col-xl-8 col-xl-offset-4">
                        <div class="width-100 text-center pull-right hidden-md-down">
                            <h2>154</h2>
                            <p>Followers</p>
                        </div>
                        <div class="width-100 text-center pull-right hidden-md-down">
                            <h2>17</h2>
                            <p>Posts</p>
                        </div>
                        <div class="profile-header-title">
                            <h2><?php echo $this->ciauth->get_user_fullname();?> <small>@<?php echo $this->ciauth->get_user('username');?></small></h2>
                            <p>Founder / CEO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Profile Header -->

    <!-- Profile -->
    <div class="row">
        <div class="col-xl-4">
            <section class="panel profile-user" style="background-image: url(<?php echo ci_public('admin');?>img/temp/photos/4.jpeg)">
                <div class="panel-body">
                    <div class="profile-user-title text-center">
                        <a class="avatar" href="javascript:void(0);">
                            <img src="<?php echo ci_public('admin');?>img/temp/avatars/1.jpg" alt="Alternative text to the image">
                        </a>
                        <br />
                        <div class="btn-group btn-group-justified" aria-label="" role="group">
                            <div class="btn-group">
                                <button type="button" class="btn width-150 swal-btn-success">Follow</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn width-150 swal-btn-success-2">Add to Friend</button>
                            </div>
                        </div>
                        <br />
                        <p>Last activity: 13 May 2016 7:26PM</p>
                        <p>
                            <span class="donut donut-success"></span>
                            Online
                        </p>
                    </div>
                </div>
            </section>
            <section class="panel">
                <div class="panel-body">
                    <h6>Actions</h6>
                    <div class="btn-group-vertical btn-group-justified">
                        <button type="button" class="btn">Send Message</button>
                        <button type="button" class="btn">Send File</button>
                        <button type="button" class="btn">Access History</button>
                        <button type="button" class="btn">Rename User</button>
                        <button type="button" class="btn">Ban User</button>
                    </div>
                </div>
            </section>
            <section class="panel">
                <div class="panel-body">
                    <div class="profile-user-skills">
                        <h6>Skills</h6>
                        <span>Management</span>
                        <progress class="progress progress-primary" value="74" max="100">74%</progress>
                        <span>Investing</span>
                        <progress class="progress progress-primary" value="82" max="100">82%</progress>
                        <span>Programming</span>
                        <progress class="progress progress-primary" value="67" max="100">67%</progress>
                        <span>Leading</span>
                        <progress class="progress progress-success" value="90" max="100">90%</progress>
                        <span>Learning</span>
                        <progress class="progress progress-danger" value="27" max="100">27%</progress>
                    </div>
                </div>
            </section>
            <section class="panel">
                <div class="panel-body">
                    <h6>Information</h6>
                    <dl class="dl-horizontal user-profile-dl">
                        <dt>Courses End</dt>
                        <dd>Digital Ocean, Nokia</dd>
                        <dt>Address</dt>
                        <dd>New York, US</dd>
                        <dt>Skills</dt>
                        <dd><span class="label label-default">html</span> <span class="label label-default">css</span> <span class="label label-default">design</span> <span class="label label-default">javascript</span></dd>
                        <dt>Last companies</dt>
                        <dd>Microsoft, Soft Mailstorm</dd>
                        <dt>Personal Information</dt>
                        <dd>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</dd>
                    </dl>
                </div>
            </section>
            <div class="widget widget-three">
                <div class="example-calendar-block"></div>
            </div>
        </div>
        <div class="col-xl-8">
            <section class="panel profile-user-content">
                <div class="panel-body">
                    <div class="nav-tabs-horizontal">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#posts" role="tab">
                                    <i class="icmn-menu3"></i>
                                    Activities
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#messaging" role="tab">
                                    <i class="icmn-bubbles5"></i>
                                    Temp Tab
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#settings" role="tab">
                                    <i class="icmn-cog"></i>
                                    Settings
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content padding-vertical-20">
                            <div class="tab-pane active" id="posts" role="tabpanel">
                                <div class="user-wall">
                                    Activities will goes here
                                </div>
                            </div>
                            <div class="tab-pane" id="messaging" role="tabpanel">
                                <div class="conversation-block">
                                   
                                     Temp tab content goes here
                                </div>
                                <div class="form-group padding-top-20 margin-bottom-0">
                                    <textarea class="form-control adjustable-textarea" placeholder="Type and press enter"></textarea>
                                    <button class="btn btn-primary width-200 margin-top-10">
                                        <i class="fa fa-send margin-right-5"></i>
                                        Send
                                    </button>
                                    <button class="btn btn-link margin-top-10">
                                        Attach File
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel">
                                <br />
                                <h5>Personal Information</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="l0">Username</label>
                                            <input type="text" class="form-control" id="l0">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="l1">Email</label>
                                            <input type="email" class="form-control" id="l1">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <h5>Password</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="l3">Password</label>
                                            <input type="password" class="form-control" id="l3">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="l4">Password</label>
                                            <input type="password" class="form-control" id="l4">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <br />
                                        <h5>Profile Avatar</h5>
                                        <div class="form-group">
                                            <label class="form-control-label" for="l6">File Upload</label>
                                            <input type="file" id="l6">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <br />
                                        <h5>Profile Background</h5>
                                        <div class="form-group">
                                            <label class="form-control-label" for="l5">File Upload</label>
                                            <input type="file" id="l5">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="form-group">
                                        <button type="button" class="btn width-150 btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- End Profile -->

	</div> <!-- end .page-content-inner -->
<?php $this->load->view('part/js'); ?>

<!-- Page Scripts -->
<script>
   
</script>
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>
