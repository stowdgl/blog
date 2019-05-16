<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">@if($comments_count>5)5+@else{{$comments_count}}@endif</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Центр Уведомлений
                </h6>
                @if(count($alertComments)>0)
                @foreach($alertComments as $alertComment)
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">Новый комментарий: {{$alertComment->comment}}</span>
                    </div>
                </a>
                @endforeach
                    @else
                    <div class="dropdown-item d-flex align-items-center" href="#">
                        <div>
                            <span class="font-weight-bold">Нет комментариев</span>
                        </div>
                    </div>
                @endif
                <div class="dropdown-item d-flex align-items-center justify-content-center" href="">
                    <div>
                        <span class="font-weight-bold "><i class="fas fa-ellipsis-h"></i> </span>
                    </div>
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="{{route('admin-request-table')}}">Показать все уведомления</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="{{URL::asset('images/person_1.jpg')}}" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
        </li>
        <li class="nav-item">
            <button id="authorize_button" >Authorize</button>
            <button id="signout_button" >Sign Out</button>

            <pre id="content" style="white-space: pre-wrap;"></pre>

            <script type="text/javascript">
                // Client ID and API key from the Developer Console
                var CLIENT_ID = '226232965648-kee8hr9b0ev9senvce61175pe2eirauq.apps.googleusercontent.com';
                var API_KEY = 'AIzaSyBMr5qibLKEmCpSDQ6SmqGJO6meByUfG98';

                // Array of API discovery doc URLs for APIs used by the quickstart
                var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/gmail/v1/rest"];

                // Authorization scopes required by the API; multiple scopes can be
                // included, separated by spaces.
                var SCOPES = 'https://www.googleapis.com/auth/gmail.readonly https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://mail.google.com https://www.googleapis.com/auth/gmail.compose';

                var authorizeButton = document.getElementById('authorize_button');
                var signoutButton = document.getElementById('signout_button');

                /**
                 *  On load, called to load the auth2 library and API client library.
                 */
                function handleClientLoad() {
                    gapi.load('client:auth2', initClient);
                }

                /**
                 *  Initializes the API client library and sets up sign-in state
                 *  listeners.
                 */
                function initClient() {
                    gapi.client.init({
                        apiKey: API_KEY,
                        clientId: CLIENT_ID,
                        discoveryDocs: DISCOVERY_DOCS,
                        scope: SCOPES
                    }).then(function (e) {

                        // Listen for sign-in state changes.
                        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

                        // Handle the initial sign-in state.
                        updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
                        authorizeButton.onclick = handleAuthClick;
                        signoutButton.onclick = handleSignoutClick;
                    }, function(error) {

                        appendPre(console.log(JSON.stringify(error, null, 2)));
                    });
                }

                /**
                 *  Called when the signed in status changes, to update the UI
                 *  appropriately. After a sign-in, the API is called.
                 */
                function updateSigninStatus(isSignedIn) {
                    if (isSignedIn) {
                        authorizeButton.style.display = 'none';
                        signoutButton.style.display = 'block';
                        listLabels();
                    } else {

                        authorizeButton.style.display = 'block';
                        signoutButton.style.display = 'none';
                    }
                }

                /**
                 *  Sign in the user upon button click.
                 */
                function handleAuthClick(event) {

                    gapi.auth2.getAuthInstance().signIn();
                }

                /**
                 *  Sign out the user upon button click.
                 */
                function handleSignoutClick(event) {
                    gapi.auth2.getAuthInstance().signOut();
                }

                /**
                 * Append a pre element to the body containing the given message
                 * as its text node. Used to display the results of the API call.
                 *
                 * @param {string} message Text to be placed in pre element.
                 */
                function appendPre(message) {
                    var pre = document.getElementById('content');
                    var textContent = document.createTextNode(message + '\n');
                    pre.appendChild(textContent);
                }

                /**
                 * Print all Labels in the authorized user's inbox. If no labels
                 * are found an appropriate message is printed.
                 */
                function listLabels() {
                    gapi.client.gmail.users.labels.list({
                        'userId': 'me'
                    }).then(function(response) {
                        var labels = response.result.labels;
                        appendPre('Labels:');

                        if (labels && labels.length > 0) {
                            for (i = 0; i < labels.length; i++) {
                                var label = labels[i];
                                appendPre(label.name)
                            }
                        } else {
                            appendPre('No Labels found.');
                        }
                    });
                }

            </script>

            <script async defer src="https://apis.google.com/js/api.js"
                    onload="this.onload=function(){};handleClientLoad()"
                    onreadystatechange="if (this.readyState === 'complete') this.onload()">
            </script>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                <img class="img-profile rounded-circle" src="{{URL::asset(auth()->user()->photo)}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('home-page')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    На сайт
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->