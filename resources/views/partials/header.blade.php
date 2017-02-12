<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Coding junkie</a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('blog.index') }}">Home</a></li>
                <li><a href="{{ route('blog.categories') }}">Categories</a></li>
                <li><a href="{{ route('others.contact') }}">Contact</a></li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>