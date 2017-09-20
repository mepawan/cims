<nav class="left-menu" left-menu>
    <div class="logo-container">
        <a href="<?php echo ci_base_url();?>" class="logo">
            <img src="<?php echo ci_public('admin');?>img/logo.png" alt="Admin Panel - <?php $ci_settings['site_name'];?>" />
            <img class="logo-inverse" src="<?php echo ci_public('admin');?>img/logo-inverse.png" alt="Admin Panel - <?php $ci_settings['site_name'];?>" />
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <ul class="left-menu-list left-menu-list-root list-unstyled">
            <li class="left-menu-list<?php if(!isset($entity) || $entity == 'dashboard'){ echo '-active'; } ?>">
                <a class="left-menu-link" href="<?php echo ci_base_url();?>admin">
                    <i class="left-menu-link-icon icmn-home2"><!-- --></i>
                    <span class="menu-top-hidden">Dashboard</span>
                </a>
            </li>
			<li class="left-menu-list<?php if(isset($entity) && $entity == 'settings'){ echo '-active'; } ?>">
                <a class="left-menu-link" href="<?php echo ci_base_url();?>admin/settings">
                    <i class="left-menu-link-icon icmn-cogs"><!-- --></i>
                    <span class="menu-top-hidden">Settings</span>
                </a>
            </li>
			<li class="left-menu-list<?php if(isset($entity) && $entity == 'pages'){ echo '-active'; } ?>">
                <a class="left-menu-link" href="<?php echo ci_base_url();?>admin/pages">
                    <i class="left-menu-link-icon icmn-cogs"><!-- --></i>
                    <span class="menu-top-hidden">Manage Pages</span>
                </a>
            </li>
			<li class="left-menu-list<?php if(isset($entity) && $entity == 'menus'){ echo '-active'; } ?>">
                <a class="left-menu-link" href="<?php echo ci_base_url();?>admin/menus">
                    <i class="left-menu-link-icon icmn-cogs"><!-- --></i>
                    <span class="menu-top-hidden">Manage Menus</span>
                </a>
            </li>
            <li class="left-menu-list-separator"><!-- --></li>
            <li>
                <a class="left-menu-link" href="<?php echo ci_base_url();?>admin/profile">
                    <i class="left-menu-link-icon icmn-profile"><!-- --></i>
                    Profile
                </a>
            </li>
            <li>
                <a class="left-menu-link" href="<?php echo ci_base_url();?>admin/messaging">
                    <i class="left-menu-link-icon icmn-bubbles5"><!-- --></i>
                    Messaging
                </a>
            </li>

            
        </ul>
    </div>
</nav>
