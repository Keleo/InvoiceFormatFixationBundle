
# Kimai - Invoice format fixation

[![CI Status](https://github.com/Keleo/InvoiceFormatFixationBundle/workflows/CI/badge.svg)](https://github.com/Keleo/InvoiceFormatFixationBundle/actions)

Kimai extension to configure a language, which will be used to format money, date and time values in invoices.

Adds a new system-configuration to the invoice section, which can be reached by clicking the "gear" icon in the invoices pge actions.

- If you don't select a language, the default behavior of Kimai applies: all values will be formatted in the invoice template language
- If you select a language, this language will be used to format all values and the invoice template language will be used for translations only   

![Screenshot](screenshot.png)

## Installation

This plugin is compatible with the following Kimai releases:

| Bundle version | Minimum Kimai version |
|----------------|-----------------------|
| 2.0            | 2.0.0                 |
| 1.0 - 1.1      | 1.17                  |
| 0.1 - 0.2      | 1.11                  |

You find the most notable changes between the versions in the file [CHANGELOG.md](CHANGELOG.md).

Download and extract the [compatible release](https://github.com/Keleo/InvoiceFormatFixationBundle/releases).

The file structure needs to look like this afterwards:

```bash
var/plugins/
├── InvoiceFormatFixationBundle
│   ├── InvoiceFormatFixationBundle.php
|   └ ... more files and directories follow here ... 
```

Then rebuild the cache:
```bash
bin/console kimai:reload --env=prod
```

Finally, change to the invoice page and open the configuration mode (via the gear icon). 
