{{ content() }}

<div align="center" class="well">

    {{ form('class': 'form-search') }}

    <div align="left">
        <h2>Log In</h2>
    </div>

        {{ form.render('email') }}
        {{ form.render('password') }}
        {{ form.render('go') }}

        {{ form.render('csrf', ['value': security.getToken()]) }}
    </form>

</div>