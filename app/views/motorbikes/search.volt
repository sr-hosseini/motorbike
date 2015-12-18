{{ content() }}

<div class="motorbike-search">
    {{ form("motorbikes/search", "method":"post", "autocomplete" : "off") }}

        <h6>Search</h6>

        <div class="clearfix">
            <label for="id">Id</label>
            {{ text_field("id", "type" : "numeric") }}
        </div>

        <div class="clearfix">
            <label for="brand">Brand</label>
            {{ text_field("brand", "size" : 30) }}
        </div>

        <div class="clearfix">
            <label for="model">Model</label>
            {{ text_field("model", "size" : 30) }}
        </div>

        <div class="clearfix">
            <label for="cc">Cc</label>
            {{ text_field("cc", "type" : "numeric") }}
        </div>

        <div class="clearfix">
            <label for="color">Color</label>
            {{ text_field("color", "size" : 30) }}
        </div>

        <div class="clearfix">
            <label for="weight">Weight</label>
            {{ text_field("weight", "size" : 30) }}
        </div>

        <div class="clearfix">
            <label for="price">Price</label>
            {{ text_field("price", "size" : 30) }}
        </div>

        <div class="clearfix">
            {{ submit_button("Search", "class": "btn btn-primary") }}
        </div>
    </form>
</div>
<div class="motorbike-results">

    <h6>Sort</h6>
    <div class="clearfix">
        {{ form("motorbikes/sort", "method":"post") }}
            {{ sortForm.render('sortBy') }}
            {{ sortForm.render('order') }}
            {{ sortForm.render('sort') }}
        {{ "</form>" }}
    </div>
    
    <h6>Results</h6>
    <table class="table table-bordered table-striped" align="center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Price</th>
                <th>Image</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for motorbike in page.items %}
                    <tr>
                        <td>{{ motorbike.getId() }}</td>
                        <td>{{ motorbike.getBrand() }}</td>
                        <td>{{ motorbike.getModel() }}</td>
                        <td>{{ motorbike.getPrice() }}</td>
                        <td>{{ image(motorbike.imageUri, "alt": motorbike.brand ~ ' ' ~ motorbike.model, "width":"64px") }}</td>
                        <td>{{ motorbike.getCreatedAt() }}</td>
                        <td>
                            {{ link_to("motorbikes/show/"~motorbike.getId(), "<i class='icon-eye-open'></i>") }}
                            {% if auth.hasIdentity() %}
                                <br />{{ link_to("motorbikes/delete/"~motorbike.getId(), "<i class='icon-remove'></i>") }}
                                <br />{{ link_to("motorbikes/edit/"~motorbike.getId(), "<i class='icon-edit'></i>") }}
                            {% endif %}
                        </td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
        <tbody>
            <tr>
                <td colspan="13" align="right">
                    <div class="btn-group">
                        {{ link_to("motorbikes/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                        {{ link_to("motorbikes/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn ") }}
                        {{ link_to("motorbikes/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                        {{ link_to("motorbikes/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    </div>
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>