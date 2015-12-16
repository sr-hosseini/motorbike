{{ content() }}

<header class="jumbotron subhead" id="overview">
    <div class="hero-unit">
        <h1>Welcome!</h1>
        <p class="lead">
            Use
            <strong><i>demo@motorbike.dev</i></strong> username and <strong><i>demo</i></strong>
            password to login as admin
        </p>

        <div align="right">
            {{ link_to('session/signup', '<i class="icon-ok icon-white"></i> Create an Account', 'class': 'btn btn-primary btn-large') }}
        </div>
    </div>
</header>

<div class="row">

    {% for motorbike in motorbikes %}
        <div class="span4">
            <div class="well">
                <h3>{{ motorbike.brand }}</h3>
                {{ image(motorbike.imageUri, "alt": motorbike.brand ~ ' ' ~ motorbike.model, "width":"200px") }}
            </div>
        </div>
    {% endfor %}

    <div class="span4">
        <h3>Name</h3>
        <address>
            <strong>sr_hosseini</strong><br>
        </address>
        <address>
            <strong>Email</strong><br>
            <a href="mailto:#">rassoulhosseini@gmail.com</a>
        </address>
    </div>

</div>
