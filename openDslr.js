
const openDslr = () => {
    require('child_process').exec('cmd /c startDslr.bat', function () {
        // …your callback code may run here…
    });
}