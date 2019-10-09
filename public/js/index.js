// View an image
const viewer = new Viewer(document.getElementById('image'), {
    inline: true,
    viewed() {
        viewer.zoomTo(1);
    },
    });

// View a list of images
const gallery = new Viewer(document.getElementById('images'));