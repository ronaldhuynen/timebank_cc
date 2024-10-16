let tagify;

document.addEventListener('DOMContentLoaded', function () {
    initializeTagify();

    // Listen for Livewire event
    Livewire.on('reinitializeTagify', () => {
        initializeTagify();
    });

    // Listen for custom event to update Tagify
    window.addEventListener('tagifyChange', function (e) {
        if (tagify) {
            tagify.loadOriginalValues(e.detail.tagsArray);
        }
    });

    window.Livewire.on('disableSelect', () => {
        document.getElementById('select-translation').style.opacity = '0.4';
        document.getElementById('select-translation').style.cursor = 'pointer';
        document.getElementById('select-translation').style.pointerEvents = 'none';
        document.getElementById('input-translation').style.opacity = '1';
    });

    window.Livewire.on('disableInput', () => {
        document.getElementById('input-translation').style.opacity = '0.4';
        document.getElementById('select-translation').style.cursor = 'default';
        document.getElementById('select-translation').style.pointerEvents = 'auto';
        document.getElementById('select-translation').style.opacity = '1';
    });
});

function initializeTagify() {
    const input = document.getElementById('tags');

    // Destroy existing Tagify instance if it exists
    if (tagify) {
        tagify.destroy();
    }

    tagify = new Tagify(input, {
        pattern: /^.{3,80}$/, // max 80 characters, make sure also validation rule in Model is equally set
        maxTags: 40,
        autocapitalize: true,
        id: 'skillTags',
        whitelist: JSON.parse(input.dataset.suggestions),
        enforceWhiteList: false,
        backspace: false,
        editTags: false,
        dropdown: {
            classname: 'bg-black text-white',
            maxItems: 10, // maximum allowed rendered suggestions
            classname: 'readonlyMix', // Foreign tags are readonly and have a distinct appearance
            enabled: 3, // characters typed to show suggestions on focus
            position: 'text', // place the dropdown near the typed text
            closeOnSelect: true, // don't hide the dropdown when an item is selected
            highlightFirst: false, // highlight / suggest best match
        },
    });

    tagify.on('dblclick', onChange);

    function onChange(e) {
        const component = Livewire.find(input.closest('[wire\\:id]').getAttribute('wire:id'));
        component.set('tagsArray', e.target.value);
        console.log('onChange is executed');
    }

    function onRemove(e) {
        onChange(e);
        // Listen for Livewire updates to modalVisible
        setTimeout(() => {
            // Your logic to remove the tag
            console.log('Removing tag after delay');
            // Example: Remove the first tag
            tagify.removeTag(e.target.value);
        }, 1000); // 1 second delay
    }

    function onLoaded(e) {
        onChange(e);
    }

    input.addEventListener('change', onChange);
    window.addEventListener('load', onLoaded);
    window.addEventListener('remove', onRemove);
}