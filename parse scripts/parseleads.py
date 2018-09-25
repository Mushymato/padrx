import re

tier = re.compile("\d[NRSU]R?")
atts = {"R": "1", "B": "2", "G": "3", "L": "4", "D": "5", "x": ""}
monsterdata = []
rarity = ""
with open("mons.txt", encoding='utf-8') as f:
    for l in f:
        line = l.split("\",\"")
        if len(line) < 5:
            w = line[0].replace("\"", "").strip()
            if w[0] == "★":
                rarity = w[1:]
            continue
        count = 0
        entry = []
        for w in line:
            w = w.replace("\"", "").strip()
            if len(w) == 0:
                continue
            if count == 0:
                if len(w) < 2 or w[1] != "/":
                    continue
                entry.append(atts[w[0]])
                entry.append(atts[w[2]])
                entry.append(w[4:])
            elif count == 1:
                entry.append(w)
                entry.append(rarity)
            elif count == 2:
                types = w.split("/")
                for t in types:
                    entry.append(t.strip())
                for i in range(3 - len(types)):
                    entry.append("")
            elif count == 3:
                stats = w.split("/")
                for s in stats:
                    entry.append(s.strip())
            elif count == 4:
                if w[0:3] == "AS:":
                    if len(w) > 3:
                        entry.append(w[4:].strip())
                    else:
                        continue
                else:
                    entry.append(w)
            else:
                # if tier.match(w):
                #     num = int(w[0])
                #     for i in range(num):
                #         entry.append(w[1])
                if w[0] == "*":
                    entry.append(w)
            count += 1
        monsterdata.append(entry)
with open("monsA.csv", "w", encoding='utf-8') as m:
    for i in monsterdata:
        for j in i:
            m.write("\"")
            m.write(j)
            m.write("\"")
            m.write(",")
        m.write("\n")
