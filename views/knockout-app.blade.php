<script>
function KnockoutApp() {

    // Reference KnockoutApp
    var self = this;

    // Define viewPort properties.
    self.ViewPort =
    {
        // Window width
        width: ko.observable(0),

        // Window height
        height: ko.observable(0),

        // Update the view port dimensions.
        update: function() {
            self.ViewPort.width( $(window).width() );
            self.ViewPort.height( $(window).width() );
        }
    };


    self.Page =
    {
        activeView: ko.observable(''),
        pageTitle: ko.observable(''),
    };

    // Define the initializer function.
    var initialize = function() {
        $(document).ready(function(){
            self.viewPort.update();
        });
    };

    // Initialize the Knockout application.
    initialize();
}

// Create the KnockoutApp instance.
var {{$appName}} = new KnockoutApp();
</script>

@foreach( $modules as $module )
{!! $module !!}
@endforeach

@foreach( $secondary as $module )
{!! $module !!}
@endforeach

<script>
    ko.applyBindings({{$appName}});

    $(document).ready(function(){
        $('.app-loading').removeClass('app-loading');
    });
</script>
