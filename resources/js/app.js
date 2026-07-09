import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Force reload when navigating back (bfcache invalidation)
window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        window.location.reload();
    }
});
