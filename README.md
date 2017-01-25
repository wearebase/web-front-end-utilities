# Info
This project is a collection of useful utilities, applicable to any web project. This includes Sass mixins.

# Install
Then include it in your composer:

```
"require": {
  "wearebase/web-front-end-utilities" : "*"
}
```

And specify a version or minimum version.

# Configure where you want the package to go
If you want to install somewhere other than `vendor`, in your `composer.json` add the following:

```
"extra": {
  "installer-paths": {
    "wp-content/themes/timber/packages/{$name}": ["wearebase/web-front-end-utilities"]
  }
}
```

# Enabling

## Sass
### Enabling Sass
Add the package to your Compass build path. In this example, I've imported all of the packages for this project.

```
add_import_path "wp-content/themes/timber/packages"
```
### Using Sass
* In your project variables, you can optionally add the following to override default values:
    * $grid-gutter-width
    * $magic-gutter
    * $magic-margin-gutters
    * $magic-padding-gutters
    * $magic-tablet-margin-gutters
    * $magic-tablet-padding-gutters
    * $magic-mobile-margin-gutters
    * $magic-mobile-padding-gutters

Order of files:
* Font Stack
* - Your project setup file -
* - Your bootstrap variables -
* Responsive
* Mixins
* - Your Sass code -
* Magic Margins

### Sass: What's included

#### Mixins
Provides a huge array of includes that will assist you in writing your CSS.

Highlights include:
* Pseudo-Element Generation
* Magical Vertical-Align
* hocus (hover + focus in one rule)
* Proportion generator
* Responsive font sizer - requires "responsive" file
* Sprite mixins
* Bonus Bootstraps!

#### Responsive
Responsive includes a bunch of responsive utilities for targeting bootstrap breakpoints - mobile, tablet, desktop, and large desktop. These will change based on your bootstrap config but will default to the bootstrap defaults if not provided.

Also provides mixins for retina devices, retina-sm, retina-xs, and iPhone 5's.

Include this file *after* your bootstrap variables.

#### Font-Stack
Include this file first in your Sass and you can use a whole load of font stacks. Totally optional but may be useful.

#### Magic Margins
Use classes like `mt4` to quickly add a margin top of 4 gutters to your item. The gutter is automatically pulled in if you're using bootstrap but defaults to 10px.

Examples of classes:
* `[type][direction][x]`: `type: p or m`, `direction: t r b l` of `x` gutters
    * Examples: `pt2`, `mb0`, `mt2`, `pl2`
* If direction is left empty then padding or margin will apply to all directions
    * Examples: `m0`, `p1`, `p4`
* Append `t-` to apply to tablets only (requires import of "responsive")
* Append `m-` to apply to mobile only (requires import of "responsive")

If you're referencing a gutter size that isn't being generated, simply adjust the variable for the amount of gutters you want. Gutters are generated from 0 up to the amount you specify.
