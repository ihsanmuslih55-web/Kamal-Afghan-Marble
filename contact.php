<?php require_once 'header.php'; ?>
<div class="container py-5">
    <h1 class="text-center mb-4">Contact Us</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <h4><i class="fas fa-map-marker-alt text-primary"></i> Our Location</h4>
                <p>3rd Zone, Jalalabad, Afghanistan</p>
                <h4><i class="fas fa-phone text-primary"></i> Phone</h4>
                <p>+93 771 886 845</p>
                <h4><i class="fas fa-envelope text-primary"></i> Email</h4>
                <p>info@kamalmarble.af</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h4>Send a Message</h4>
                <form action="https://formspree.io/f/mdabzneg" method="POST">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" rows="5" class="form-control" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>