{{ content() }}
{{ form("motorbikes/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("motorbikes", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit motorbikes</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="make">Make</label>
        </td>
        <td align="left">
            {{ text_field("make", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="model">Model</label>
        </td>
        <td align="left">
            {{ text_field("model", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="cc">Cc</label>
        </td>
        <td align="left">
            {{ text_field("cc", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="color">Color</label>
        </td>
        <td align="left">
            {{ text_field("color", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="weight">Weight</label>
        </td>
        <td align="left">
            {{ text_field("weight", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="price">Price</label>
        </td>
        <td align="left">
            {{ text_field("price", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="image">Image</label>
        </td>
        <td align="left">
            {{ text_field("image", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
