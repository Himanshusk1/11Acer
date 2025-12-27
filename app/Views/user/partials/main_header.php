<section class="hero-panel" data-aos="fade-up">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <p class="text-uppercase text-muted small mb-1">Welcome back</p>
            <h2 class="mb-2">Hi <?= esc($userFullName) ?>, manage everything in one place</h2>
            <p class="text-muted mb-0">Keep your profile updated, publish listings faster, and stay on top of messages & billing.</p>
        </div>
        <div class="d-flex flex-column flex-sm-row gap-2">
            <a href="<?= site_url('post-your-property') ?>" class="btn btn-brand"><i class="bi bi-house-add me-2"></i>Quick Post</a>
        </div>
    </div>
</section>
