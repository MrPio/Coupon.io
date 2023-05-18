<link rel="stylesheet" href="{{asset('css/layouts/account_navbar.css')}}">


<div class="account_navbar--container">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'profile')" id="defaultOpen"><h3>Profile</h3></button>
        <button class="tablinks" onclick="openTab(event, 'projects')"><h3>Profile</h3></button>
        <button class="tablinks" onclick="openTab(event, 'photos')"><h3>Profile</h3></button>
        <button class="tablinks" onclick="openTab(event, 'friends')"><h3>Profile</h3></button>
        <button class="tablinks" onclick="openTab(event, 'groups')"><h3>Profile</h3></button>
    </div>

    <div id="profile" class="tabcontent">

        <h3>ABOUT</h3>

        <button id="edit" class="account_editing" style="float:right">EDIT</button>

        <div class="row">
            <div class="dat-col titles">
                <table>
                    <tr>
                        <td>First Name:</td>
                    </tr>
                    <tr>
                        <td>User Name:</td>
                    </tr>
                    <tr>
                        <td>City:</td>
                    </tr>
                    <tr>
                        <td>Birthday:</td>
                    </tr>
                    <tr>
                        <td>Website:</td>
                    </tr>
                </table>
            </div>
            <div class="dat-col">
                <table>
                    <tr>
                        <td>Mariah</td>
                    </tr>
                    <tr>
                        <td>Mariah</td>
                    </tr>
                    <tr>
                        <td>Los Angeles</td>
                    </tr>
                    <tr>
                        <td>Jan 22, 1984</td>
                    </tr>
                    <tr>
                        <td><a href="#">Vendroid.venmond.com</a></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>


<div id="projects" class="tabcontent">
    <h3>List of Projects</h3>
    <p>Content goes here.</p>
</div>

<div id="photos" class="tabcontent">
    <h3>Photos</h3>
    <p>Content goes here.</p>
</div>

<div id="friends" class="tabcontent">
    <h3>Friends</h3>
    <p>Content goes here.</p>
</div>

<div id="groups" class="tabcontent">
    <h3>Groups</h3>
    <p>Content goes here.</p>
</div>
</div>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();


</script>

