{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("motorbikes/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("motorbikes/new", "Create motorbike", "class": "btn btn-primary") }}
    </li>
</ul>

<div class="motorbike-search">
    {{ form("motorbikes/search", "method":"post", "autocomplete" : "off") }}

    <h2>Search motorbikes</h2>

    <div class="clearfix">
        <label for="id">Id</label>
        {{ text_field("id", "type" : "numeric") }}
    </div>

    <div class="clearfix">
        <label for="make">Brand</label>
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

</div>
<div class="motorbike-results">
    <table class="table table-bordered table-striped" align="center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Cc</th>
                <th>Color</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Modified At</th>
            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for motorbike in page.items %}
                    <tr>
                        <td>{{ motorbike.getId() }}</td>
                        <td>{{ motorbike.getBrand() }}</td>
                        <td>{{ motorbike.getModel() }}</td>
                        <td>{{ motorbike.getCc() }}</td>
                        <td>{{ motorbike.getColor() }}</td>
                        <td>{{ motorbike.getWeight() }}</td>
                        <td>{{ motorbike.getPrice() }}</td>
                        <td>{{ motorbike.getImage() }}</td>
                        <td>{{ motorbike.getCreatedAt() }}</td>
                        <td>{{ motorbike.getModifiedAt() }}</td>
                        <td>{{ link_to("motorbikes/edit/"~motorbike.getId(), "Edit") }}</td>
                        <td>{{ link_to("motorbikes/delete/"~motorbike.getId(), "Delete") }}</td>
                        <td>{{ link_to("motorbikes/show/"~motorbike.getId(), "Show") }}</td>
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