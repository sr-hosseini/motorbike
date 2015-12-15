{{ form("motorbikes/create", "method":"post", "enctype":"multipart/form-data") }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("motorbikes", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Save", "class": "btn btn-success") }}
        </li>
    </ul>

    {{ content() }}

    <div class="center scaffold">
        <h2>Create a Motorbike</h2>

        <div class="clearfix">
            <label for="name">Brand</label>
            {{ form.render("brand") }}
            {{ form.messages("brand") }}
        </div>

        <div class="clearfix">
            <label for="email">Model</label>
            {{ form.render("model") }}
            {{ form.messages("model") }}
        </div>

        <div class="clearfix">
            <label for="email">CC</label>
            {{ form.render("cc") }}
            {{ form.messages("cc") }}
        </div>

        <div class="clearfix">
            <label for="email">Color</label>
            {{ form.render("color") }}
            {{ form.messages("color") }}
        </div>

        <div class="clearfix">
            <label for="email">Weight</label>
            {{ form.render("weight") }}
            {{ form.messages("weight") }}
        </div>

        <div class="clearfix">
            <label for="email">Price</label>
            {{ form.render("price") }}
            {{ form.messages("price") }}
        </div>

        <div class="clearfix">
            <label for="email">Image</label>
            {{ form.render("image") }}
            {{ form.messages("image") }}
        </div>

        {{ form.render('csrf', ['value': security.getToken()]) }}
        {{ form.messages('csrf') }}

    </div>

</form>