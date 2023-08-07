<!-- index.html -->

<!DOCTYPE html>
<html>

<head>
    <title>Control Relay</title>
</head>

<body>
    <h1>Control Relay</h1>
    <button onclick="toggleRelay(1, true)">Aktifkan Relay 1</button>
    <button onclick="toggleRelay(1, false)">Matikan Relay 1</button>
    <button onclick="toggleRelay(2, true)">Aktifkan Relay 2</button>
    <button onclick="toggleRelay(2, false)">Matikan Relay 2</button>

    <script>
    async function toggleRelay(relayNumber, state) {
        try {
            const response = await fetch(`/toggle-relay/${relayNumber}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    state: state ? 'on' : 'off'
                })
            });
            console.log(response.status);
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function getConnectedRelays() {
        try {
            const response = await fetch('/connected-relays');
            const data = await response.json();
            console.log('Relay yang terhubung:', data);
        } catch (error) {
            console.error('Error:', error);
        }
    }

    getConnectedRelays();
    </script>
</body>

</html>