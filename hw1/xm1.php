<?php
/*
    function: rotate_n
    parameters:
        string input - input string to be encoded
        int offset - offset for letters, default 13
        int add - addition for digits, default 5
    return: encoded string
    description:
        rotate letters by offset, digits by addition
        e.g. offset = 2, add = 3
        a -> c, z -> b
        A -> C, Z -> B
        0 -> 3, 7 -> 0, 9 -> 2
*/
function rotate_n(string $input, int $offset = 13, int $add = 5): string
{
    $res = "";
    $len = strlen($input);
    for($i = 0; $i < $len; $i++) {
        $c = ord($input[$i]);
        if ($c >= ord('0') && $c <= ord('9')) {
            $c = ($input[$i] + $add) % 10;
            $res .= $c;
        } else{
            if ($c >= ord('a') && $c <= ord('z')) {
                $c = (($c - ord('a') + $offset) % 26) + ord('a');
            } else if ($c >= ord('A') && $c <= ord('Z')) {
                $c = (($c - ord('A') + $offset) % 26) + ord('A');
            }
            $res .= chr($c);
        }
    }
    return $res;
}


/*
    function: table_caesar
    parameters:
        string input - input string to be encoded
    return: encoded string
    description:
        encode letters by a fixed table
        e.g. a -> b, z -> a
             A -> B, Z -> A
             other characters remain unchanged
*/
function table_caesar(string $input): string
{
    // some type of simple, naive cipher table; offset = 1.
    $table = array(
        'a' => 'b',
        'b' => 'c',
        'c' => 'd',
        'd' => 'e',
        'e' => 'f',
        'f' => 'g',
        'g' => 'h',
        'h' => 'i',
        'i' => 'j',
        'j' => 'k',
        'k' => 'l',
        'l' => 'm',
        'm' => 'n',
        'n' => 'o',
        'o' => 'p',
        'p' => 'q',
        'q' => 'r',
        'r' => 's',
        's' => 't',
        't' => 'u',
        'u' => 'v',
        'v' => 'w',
        'w' => 'x',
        'x' => 'y',
        'y' => 'z',
        'z' => 'a',
        'A' => 'B',
        'B' => 'C',
        'C' => 'D',
        'D' => 'E',
        'E' => 'F',
        'F' => 'G',
        'G' => 'H',
        'H' => 'I',
        'I' => 'J',
        'J' => 'K',
        'K' => 'L',
        'L' => 'M',
        'M' => 'N',
        'N' => 'O',
        'O' => 'P',
        'P' => 'Q',
        'Q' => 'R',
        'R' => 'S',
        'S' => 'T',
        'T' => 'U',
        'U' => 'V',
        'V' => 'W',
        'W' => 'X',
        'X' => 'Y',
        'Y' => 'Z',
        'Z' => 'A',
    );
    $len = strlen($input);
    for($i = 0; $i < $len; ++$i)
        if(array_key_exists($input[$i], $table))
            $input[$i] = $table[$input[$i]];

    return $input;
}

/*
    main function
    parameters:
        array argv - command line arguments
    commandline arguments (all required):
        task_number - 1 or 2
        in file - input file path
        out file - output file path
    return: void
    description:
        parse command line arguments
        call corresponding function
        write result to output file
*/
function main(array $argv): void
{
    $argc = count($argv);

    // check number of commandline args
    if ($argc != 4)
    {
        echo "Usage: php xm1.php <task_number> <in file> <out file>\n";
        return;
    }

    // read in commandline params
    $in_file = $argv[2];
    $out_file = $argv[3];
    $task_type = $argv[1];

    // avoid crash because of an invalid i file
    if (!file_exists($in_file))
    {
        echo "Input file $in_file does not exist\n";
        return;
    }
    $content = file_get_contents($argv[2]);

    // task type branches
    if ($task_type == "1")
        $res = rotate_n($content);
    else if ($task_type == "2")
        $res = table_caesar($content);
    else
    {
        echo "Invalid task number $task_type\n";
        return;
    }

    // write to o file
    file_put_contents($out_file, $res);
    return;
}
main($argv);
?>