<?php
/**
 * Login html/php file
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

require_once 'src/utils/actions/login.php';
?>
<script src="src/javascript/actions/login.js"></script>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form>
                <div class="mb-3">
                    <label for="nameemail" class="form-label">Username / Email</label>
                    <input type="text" class="form-control" id="nameemail" name="nameemail" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="doLogin()">Submit</button>
            </form>
            <p class="mt-3">Don't have an account? <a href="index.php?action=Register">Sign up here</a>.</p>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>