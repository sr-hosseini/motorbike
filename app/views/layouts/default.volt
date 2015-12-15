<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container" style="width: auto;">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      {{ link_to(null, 'class': 'brand', 'MotorBike')}}
        <div class="nav-collapse">

          <ul class="nav">

            {%- set menus = [
              'Home': null,
              'About': 'about',
              'MotorBikes': 'motorbikes'
            ] -%}

            {% if auth.hasIdentity() %}
                {%- set menus['Users'] = 'users' -%}
            {% endif %}

            {%- for key, value in menus %}
              {% if value == dispatcher.getControllerName() %}
              <li class="active">{{ link_to(value, key) }}</li>
              {% else %}
              <li>{{ link_to(value, key) }}</li>
              {% endif %}
            {%- endfor -%}

          </ul>

        <ul class="nav pull-right">
            {% if auth.hasIdentity() %}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth.getName() }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>{{ link_to('session/logout', 'Logout') }}</li>
                    </ul>
                </li>
            {% else %}
                <li>{{ link_to('session/login', 'Login') }}</li>
            {% endif %}
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container">
    {{ content() }}
</div>