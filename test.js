const data = [
    { name: ["eq"] },
    { type: ["eq"] },
    { email: ["eq"] },
    { address: ["eq"] },
    { city: ["eq"] },
    { state: ["eq"] },
    { postalCode: ["eq", "gt", "lt"] },
];

for (let item of data) {
    console.log(item)
}
