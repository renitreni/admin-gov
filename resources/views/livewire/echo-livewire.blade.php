<div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module">
        import Echo from 'https://cdn.jsdelivr.net/npm/laravel-echo@2.0.2/+esm'

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'bfcc97d7f08a7a70198e',
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = window.Echo.channel('rescue-channel')
            .listen(".App\\Events\\RescueEvent", function (data) {
                Swal.fire({
                    title: 'New Agent Rescue Detected!',
                    text: JSON.stringify(data),
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
                window.Livewire.dispatch('rescueBanner');
            });
    </script>
</div>