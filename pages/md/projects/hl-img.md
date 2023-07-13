![Dynamic JSON Badge](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Fraw.githubusercontent.com%2Fstrawmelonjuice%2Fhl-img.js%2Fmain%2Fpackage.json&query=%24.version&label=Version&labelColor=%23313333&color=%23eebcbc&link=https%3A%2F%2Fgithub.com%2Fstrawmelonjuice%2Fhl-img.js&link=https%3A%2F%2Fwww.npmjs.com%2Fpackage%2Fhl-img%3FactiveTab%3Dversions) [![license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/strawmelonjuice/hl-img.js/blob/main/LICENSE)
[![](https://data.jsdelivr.com/v1/package/npm/hl-img/badge)](https://www.jsdelivr.com/package/npm/hl-img)

I added a custom element into my site for highlightable images, now I need to make it a repo so I don't lose track.
## NOTE:
> Google does not like the use of elements like these, mainly because browsers or bots that don't fire the javascript, will not be able to see any images. _Though Google's HTML-checker web.dev loads `hl-img.js` in their tests, allowing it to pass that test after all._

## Embed using jsdelivr
### Latest version

#### From GitHub (per commit)
<details> 
  <summary><b>May be a bit behind on GitHub due to cache refreshes! Is also hard to debug, as there is no exact version number!</b></summary>

  _Minified_
```html
<script defer src="https://cdn.jsdelivr.net/gh/strawmelonjuice/hl-img.js@<commit id>/hl-img.min.js"></script>
```

_Unminified_
```html
<script defer src="https://cdn.jsdelivr.net/gh/strawmelonjuice/hl-img.js@<commit id>/hl-img.js"></script>
```

Thanks to the `defer` attribute, they'll load after the body is loaded, so you _can_ place them anywhere. However, for best reliability, please add this at the end of the `<body>`.
</details>

#### From NPM (per version)
_Minified_
```html
<script defer src="https://cdn.jsdelivr.net/npm/hl-img@1/hl-img.min.js"></script>
```
_Unminified_
```html
<script defer src="https://cdn.jsdelivr.net/npm/hl-img@1/hl-img.js"></script>
```
Thanks to the `defer` attribute, they'll load after the body is loaded, so you _can_ place them anywhere. However, for best reliability, please add this at the end of the `<body>`.

### Version-specific

For version-specific jsdelivr's, see <https://cdn.jsdelivr.net/npm/hl-img/>.
## Install using NPM
```bash
npm i hl-img
```

## Attributes
### An example
```html
<hl-img preview="/assets/img/media/art/MM2.png" alt="MouseMouse!" highlight="/assets/img/media/art/MM2.webp"></hl-img>
```
[This](https://strawmelonjuice.com/blog?p=posts/art/mousemouse-3.2) was my first use case of `<hl-img>`.
### Supported
- `preview` – The `preview`-attribute is used as the `src` attribute when the image is _not_ in highlight-mode. If not specified, will be inherited from `src`.

- `highlight` – The `highlight`-attribute is used as the `src` attribute when the image is currently in highlight-mode. If not specified, will be inherited from `preview`.

- `href` – `href` attributes specify which link to open on clicking on the highlighted image.

### Inherited
- `alt` – The `<img>`'s `alt`-attribute is copied one-on-one. No changes in functioning.

- `src` – `<hl-img>`-elements do support `<img>`'s `src`-attribute, but will only use it as a fallback, in case `preview` is not specified.

- `style` – Styles are inherited, but may be altered by `hl-img.js`.

- `id` and `class` – Ids and classes are inherited, however, if none are specified, `hl-img.js` will assign them. It will also add the `hl-image` class in all cases.

- `width` and `height` – Are inherited.

### Future support

Add an issue if you're missing anything.

## Customization

Before calling `hl-img.js`, you can declare some of it's options, if you don't, their defaults will be used.

An example of how an custom configuration would look in HTML:

```HTML
<html>
    <head>
        ...
    </head>
<body>
   ...
    <main>
        ...
    </main>
<script type="text/javascript">
    const hlimg_options = {
      styling_closenotif_positioning: "bottom: 2em; right: 4em;",
      styling_closenotif_colors_background: "#FFF",
      styling_closenotif_colors_text: "#000",
      styling_imageshow_zIndex: 900000,
      styling_imageshow_colors_background: "#000",
      styling_imageshow_border_radius: "25%",
	};
</script>
<script defer src="hl-img.js"></script>
</body>
</html>
```

Note that these changes happen globally, so they'll be applied to the entire page, the moment `hl-img.js` is ran.

### List of customization variables

- Timing:

  - `timing_fade_opacity`  (number) – The time in seconds of the fade-in/fade-out animation on the images. Default: `0.5`

  - `timing_pop_location` (number)  – Time in miliseconds to wait before moving images. By default a little longer than `timing_fade_opacity` so that it can run its animation. Default: `700`

- Styling

  - Closing modal

    - `styling_closenotif_positioning` (string) – CSS code for positioning the closing modal. Default: `"top: 2em; right: 2em"`

    - `styling_closenotif_colors_background` (string) – Background colour for the closing modal. Default: `"#000"`

    - `styling_closenotif_colors_text` (string) – Text colour for the closing modal. Default: `"#FFF"`

    - `styling_closenotif_border_thickness` (string) – Border thickness for the closing modal. Default: `"2.5px"`

    - `styling_closenotif_border_type` (string) – Type of the closing modal's border, CSS value. Default: `"solid"`

    - `styling_closenotif_border_color`  (string) –  The colour of the closing modal's border. Default: `"#848484"`

    - `styling_closenotif_padding` (string) – Padding for the text inside the closing modal. Default: `"4px"`

  - Highlighted image

    - `styling_imageshow_zIndex` (number) – Z-Index for the image when highlighted, the Z-Index of the closing modal will always be this +1. CSS value. Default: `900`

    -   `styling_imageshow_positioning` (string) – CSS code for positioning the highlighted image. Default: `top: 20%; bottom: 20%; left: 10%; right: 10%"`

    - `styling_imageshow_colors_background` (string) – Background colour for highlighted image -- shows when image is transparent. Default: `"#f5f5f5"`

    - `styling_imageshow_border_thickness` (string) – Border thickness for the highlighted image. Default: `".2em"`
    - `styling_imageshow_border_type` (string) – Type of the highlighted images' border, CSS value. Default: `"solid"`
    - `styling_imageshow_border_color` (string) – Highlighted images' border color. Default:`"currentColor"`
    - `styling_imageshow_border_radius` – Border radius for highlighted image. Default:`"0%"`

  - `styling_hlimg_maxwidth` – Max-width for all `<hlimg>`'s. Set to `""` To disable. Default: `"80%"`
