<?php
$active = $active ?? '';
?>
<nav class="sidebar" id="admin-sidebar">
    <h3 class="sidebar-header">11 Acer<span>.</span></h3>
    <ul class="nav flex-column">
        <h6>Management</h6>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'users' ? 'active' : '' ?>" href="<?= site_url('/admin') ?>" style="min-width: max-content;">
                <i class="bi bi-people-fill icon"></i> User Management
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'properties' ? 'active' : '' ?>" href="<?= site_url('/admin/properties') ?>">
                <i class="bi bi-building-fill icon"></i> Property Listings
            </a>
        </li>
        <h6>Finance</h6>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'payments' ? 'active' : '' ?>" href="<?= site_url('/admin/payments') ?>">
                <i class="bi bi-currency-dollar icon"></i> Payments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'appointments' ? 'active' : '' ?>" href="<?= site_url('/admin/appointments') ?>">
                <i class="bi bi-calendar-check icon"></i> Appointments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'referrals' ? 'active' : '' ?>" href="<?= site_url('/admin/referrals') ?>">
                <i class="bi bi-link-45deg icon"></i> Referrals
            </a>
        </li>
        <h6>Leads Desk</h6>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'residential-leads' ? 'active' : '' ?>" href="<?= site_url('/admin/residential-leads') ?>">
                <i class="bi bi-house-door-fill icon"></i> Residential Leads
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'commercial-visits' ? 'active' : '' ?>" href="<?= site_url('/admin/commercial-visits') ?>">
                <i class="bi bi-building-gear icon"></i> Commercial Visits
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'service-enquiries' ? 'active' : '' ?>" href="<?= site_url('/admin/service-enquiries') ?>">
                <i class="bi bi-chat-square-text-fill icon"></i> Service Enquiries
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'contact-requests' ? 'active' : '' ?>" href="<?= site_url('/admin/contact-requests') ?>">
                <i class="bi bi-inbox-fill icon"></i> Contact Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'feedback' ? 'active' : '' ?>" href="<?= site_url('/admin/feedback') ?>">
                <i class="bi bi-chat-dots-fill icon"></i> Feedback
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active === 'settings' ? 'active' : '' ?>" href="<?= site_url('/admin/settings') ?>">
                <i class="bi bi-gear-fill icon"></i> Settings
            </a>
        </li>
        <li class="nav-item mt-auto">
            <a class="nav-link" href="<?= site_url('api/auth/logout') ?>">
                <i class="bi bi-box-arrow-left icon"></i> Logout
            </a>
        </li>
    </ul>
</nav>
