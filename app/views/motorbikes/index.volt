{{ content() }}

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

</form>
