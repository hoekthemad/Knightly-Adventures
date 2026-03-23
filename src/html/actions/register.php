<?php
/**
 * Register html/php file
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

require_once 'src/utils/actions/register.php';
?>
<script src="src/javascript/actions/register.js"></script>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="doRegister()">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>