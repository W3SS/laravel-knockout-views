<script>
function KnockoutApp() {

    // Reference KnockoutApp
    var self = this;

    // Define viewPort properties.
    self.viewPort =
    {
        // Window width
        width: ko.observable(0),

        // Window height
        height: ko.observable(0),

        // Update the view port dimensions.
        update: function() {
            self.viewPort.width( $(window).width() );
            self.viewPort.height( $(window).width() );
        }
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
var App = new KnockoutApp();
</script>