{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("motorbikes/search", "&larr; Go Back") }}
    </li>
</ul>

<div align="center">
    <div class="clearfix motorbike">
        <div class="left motorbike-title">
            <h1>{{ motorbike.brand }}</h1>
            <h2>{{ motorbike.model }}</h2>
            <div class="price">
                <span>Price</span>
                <h2>{{ motorbike.price }}</h2>
            </div>
        </div>
        <div class="right motorbike-image">
            {{ image(motorbike.imageUri, "alt": motorbike.brand ~ ' ' ~ motorbike.model, "width":"300px") }}
        </div>
    </div>
    <table class="table table-bordered table-striped" align="center">
        <thead>
            <tr>
                <th colspan="2"><h4>Details</h4></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ motorbike.getId() }}</td>
            </tr>
            <tr>
                <th>CC</th>
                <td>{{ motorbike.getCc() }}</td>
            </tr>
            <tr>
                <th>Color</th>
                <td>{{ motorbike.getColor() }}</td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>{{ motorbike.getWeight() }}</td>
            </tr>
        </tbody>
    </table>
</div>
