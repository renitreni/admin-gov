<div class="button-container">
    <div type="button" class="button-base">
        <button type="button" class="button-top" wire:click='sendEmergency'>
            <div class="button-shine"></div>
            <span class="button-text">Emergency</span>
        </button>
    </div>

    <input type="text" id="lat" name="lat" wire:model='lat' class="hidden" hidden>

    <input type="text" id="lng" name="lng" wire:model='lng' class="hidden" hidden>

    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    document.getElementById("lat").value = lat;
                    document.getElementById("lng").value = lng;
                },
                (error) => {
                    console.error("Geolocation error:", error.message);
                }
            );
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    </script>
</div>
