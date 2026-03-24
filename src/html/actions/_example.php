<div class="row">
    <div class="col-md-12">
        <div class="jumbotron-fluid">
            <h4>DB and System Overview</h4>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>The file Structure</h5>
                            <hr />
                        </div>
                        <div class="col-sm-12">
                            The main view is made in 4-5 parts;
                            <ul>
                                <li>An action on the URL (dashboard.php?action=village for example).</li>
                                <li>An action file (found in src/html/action/{file}.php). This is always the same name as the ?action=X from the URL.</li>
                                <li>A utils file for the action (found in src/utils/{file}.php). This does not have to have the same name, but makes it easy to link if they do.</li>
                                <li>A javscript file for the action (found in src/javscript/actions/{file}.php). This does not have to have the same name, but makes it easy to link if they do.</li>
                                <li>[If required] An AJAX file (found in src/ajax/actions/{file}.php). Does not have to have the same name, but we'll come back to that.</li>
                            </ul>
                            <hr />The action on the URL tells dashboard which src/html/actions/ file to include
                            <hr />Any and all output goes in the src/html/action file.
                            <hr />Any data collection / page required functions (that don't alter data in the database) are handled in utils.
                            <hr />The javascript file will handle client side processing for the page
                            <hr />Any data modification or creation is handled by the AJAX file.
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Getting information from the database</h5>
                            <hr />
                        </div>
                        <div class="col-sm-12">
                            To get information from the database related to a specific action, use the previously created utils for the page. Inside this, create a function.
                            <br>Inside the function, we want to make sure that it is aware of the Database connection class (this is already set up and waiting to be used), this is done by making it "global", such as;
<code><pre>&lt;?php
function getUsers() {
    global $connection;
}
</pre></code>
                            We then want to prepare the statement to use, in the example, the users in the database, this is done with the <code>$connection->prepare</code> function, such as;
<code><pre>&lt;?php
function getUsers() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM users;");
}
</pre></code>
                            This gives us a "<code>prepared statement</code>" to use with the database to get info out, so we need to execute the query;
<code><pre>&lt;?php
function getUsers() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM users;");
    $stmt->execute();
}
</pre></code>
                            This will run the query, it's at this point that any errors in your query will be displayed, possibly at a fatal error level, so try/catch blocks may be your friend here!
                            <br /><br />
                            At this point, we are ready to use the it to get info back from the database, we do this with the following;
<code><pre>&lt;?php
function getUsers() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM users;");
    $stmt->execute();
    $result = $stmt->get_result();
}
</pre></code>
                            We added the <code>$result = $stmt->get_result();</code>, this puts all of the records into a handy variable for us to use, either as a single row;
<code><pre>&lt;?php
function getUsers() {
    global $connection;
    $stmt = $connection->prepare("SELECT uid FROM users;");
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_array();
    return $row['uid'];
}
</pre></code>
                            Or looped to get each record;
<code><pre>&lt;?php
function getUsers() {
    global $connection;
    $stmt = $connection->prepare("SELECT uid FROM users;");
    $stmt->execute();
    $result = $stmt->get_result();

    $foundUsers = [];

    while ($row = $result->fetch_array()) {
        $foundUsers[] = $row['uid'];
    }
    return $foundUsers;
}
</pre></code>
                            You can also use passed variables in the query with <code>$stmt->bind_param()</code> such as;
<code><pre>&lt;?php
function getUsers() {
    $usersToLookFor = "Active";
    global $connection;
    $stmt = $connection->prepare("SELECT uid FROM users WHERE status = ?;");
    $stmt->bind_param("s", $usersToLookFor);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_array();
}
</pre></code>
                            Which in this case would only get "active" users
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Sending info to the database</h5>
                            <hr />
                        </div>
                        <div class="col-sm-12">
                            TO send
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>