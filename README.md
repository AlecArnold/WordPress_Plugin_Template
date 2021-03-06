# WordPress Plugin Template

Work in progress...

## Installation

### Create your own Plugin

1. Navigate into your projects WordPress plugin directory.
```
cd <path>/wp-content/plugins
```

2. Download the template.
```
git clone git@github.com:AlecArnold/WordPress_Plugin_Template.git example-plugin
```

3. Navigate into the newly created plugin directory.
```
cd example-plugin
```

4. Untether your repo from `AlecArnold/WordPress_Plugin_Template`.
```
git remote rm origin
```

5. Remove the "WordPress_Plugin_Template" `README.md`.
```
git rm README.md
```

6. Rename the plugin boot file.
```
mv class-plugin-name.php class-example-plugin.php
```

7. Rename the plugin namespace.
```
find ./ -type f -exec sed -i '' -e 's/Plugin_Name/Example_Plugin/g' {} \;
```

8. Rename the plugin slug.
```
find ./ -type f -exec sed -i '' -e 's/plugin-name/example-plugin/g' {} \;
```

9. Update the plugin information in the boot file and `readme.txt`.

## License

This is free and unencumbered software released into the public domain.

Anyone is free to copy, modify, publish, use, compile, sell, or
distribute this software, either in source code form or as a compiled
binary, for any purpose, commercial or non-commercial, and by any
means.

In jurisdictions that recognize copyright laws, the author or authors
of this software dedicate any and all copyright interest in the
software to the public domain. We make this dedication for the benefit
of the public at large and to the detriment of our heirs and
successors. We intend this dedication to be an overt act of
relinquishment in perpetuity of all present and future rights to this
software under copyright law.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

For more information, please refer to <http://unlicense.org/>
